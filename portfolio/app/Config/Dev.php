<?php

/* Configuration DEV */

$app['db.options'] = array(
	'driver' => 'pdo_mysql',
	'host' => 'localhost',
	'dbname' => 'portfolio_nicolas_v5',
	'port'     => 3306,
	'user' => 'root',
	'password' => 'mdp',
	'charset' => 'utf8'
);

$app['debug'] = true;