#!/usr/bin/env bash

# Use single quotes instead of double quotes to make it work with special-character passwords
SERVERNAME='portfolio.local'
PROJECTFOLDER='portfolio'

dbName='portfolio_nicolas_v5'
PASSWORD='mdp'

# create project folder
sudo mkdir "/var/www/html/${PROJECTFOLDER}"

# update / upgrade
sudo apt-get update
sudo apt-get -y upgrade

# install apache 2.5 and php 5.5
sudo apt-get install -y apache2
sudo apt-get install -y php5

# install mysql and give password to installer
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $PASSWORD"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $PASSWORD"
sudo apt-get -y install mysql-server
sudo apt-get install php5-mysql

# install phpmyadmin and give password(s) to installer
# for simplicity I'm using the same password for mysql and phpmyadmin
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"
sudo apt-get -y install phpmyadmin

# setup hosts file
VHOST=$(cat <<EOF
<VirtualHost *:80>
    ServerName $SERVERNAME
    DocumentRoot "/var/www/html/${PROJECTFOLDER}/web"
    <Directory "/var/www/html/${PROJECTFOLDER}/web">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF
)
echo "${VHOST}" > /etc/apache2/sites-available/000-default.conf

# enable mod_rewrite
sudo a2enmod rewrite

# restart apache
service apache2 restart

# install git
sudo apt-get -y install git

# install Composer
cd "/vagrant/${PROJECTFOLDER}"
curl -s https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
alias composer=/usr/local/bin/composer
composer update

# look to see if the database is installed yet
result=`mysqlshow --user=root $dbName | grep -v Wildcard | grep -o $dbName`

if [ "$result" == $dbName ]
  # if it's already installed, just indicate such
  then
    echo 'Database already installed.'

  # if it's not installed, install it using the daptive_dma profile
  else
    echo "$result - $dbName"
    echo "Database $dbName not yet installed... installing using mysql"

    mysql -u root -pmdp -e "CREATE DATABASE IF NOT EXISTS $dbName;"
    mysql $dbName -u root -pmdp < /vagrant/data/db.sql

    # not using drush anymore for this
    echo "Database $dbName should be installed, drop then run this script again to reinstall."
fi

# IP address
ifconfig  | grep 'inet addr:'| grep -v '127.0.0.1' | grep -v '10.0.2' | grep -v '10.11.12.1' | cut -d: -f2 | awk '{ print "http://"$1"/"}' > vagrant_hosts
cat vagrant_hosts