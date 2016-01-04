
### REQUIRED ###

# Install Virtualbox
sudo apt-get install virtualbox

# Install Vagrant
sudo apt-get install vagrant

# Add vagrant box ubuntu/trusty64
vagrant box add ubuntu/trusty64


### INSTALLATION ###
git clone https://nicolastorre@bitbucket.org/nicolastorre/portfolio.git

cd portfolio

### START ###
vagrant up

### WEBSITE ###
Add to /etc/hosts: 192.168.33.22   portfolio.local

Visit: http://portfolio.local/

### END ###
vagrant suspend OR vagrant halt


### Doctrine ORM ###

# Create database
php vendor/bin/doctrine orm:schema-tool:create

# Update database
php vendor/bin/doctrine orm:schema-tool:update --force

# Drop database
php vendor/bin/doctrine orm:schema-tool:drop --force
