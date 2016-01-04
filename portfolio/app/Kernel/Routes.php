<?php

// Login authentication
$app->get('/login', 'authenticationController:loginAction')->bind('login');
//$app->get('/logout', 'authenticationController:logoutAction')->bind('logout');

// Articles blog
$app->get('/', 'articleController:indexAction')->bind('home');
$app->get('/admin/article/list', 'articleController:listAction')->bind('listArticle');
$app->get('/article/show/{id}', 'articleController:showAction')->bind('showArticle');
$app->match('/admin/article/add', 'articleController:addAction')->bind('addArticle');
$app->match('/admin/article/edit/{id}', 'articleController:editAction')->bind('editArticle');
$app->match('/admin/article/delete', 'articleController:deleteAction')->bind('deleteArticle');

$app->match('/paiement/list', 'paiementController:indexAction')->bind('command');
$app->match('/paiement/cancel', 'paiementController:cancelAction')->bind('cancel');
$app->match('/paiement/reponse', 'paiementController:reponseAction')->bind('reponse');
$app->match('/paiement/autoreponse', 'paiementController:autoreponseAction')->bind('autoreponse');


// Bio
$app->get('/bio', 'bioController:indexAction')->bind('indexBio');
$app->get('/admin/bio/list', 'bioController:listAction')->bind('listBio');
$app->match('/admin/bio/add', 'bioController:addAction')->bind('addBio');
$app->match('/admin/bio/edit/{id}', 'bioController:editAction')->bind('editBio');
$app->match('/admin/bio/delete', 'bioController:deleteAction')->bind('deleteBio');

// Diploma
$app->match('/admin/diploma/add/{idbio}', 'diplomaController:addAction')->bind('addDiploma');
$app->match('/admin/diploma/edit/{id}', 'diplomaController:editAction')->bind('editDiploma');
$app->match('/admin/diploma/delete', 'diplomaController:deleteAction')->bind('deleteDiploma');

// Exp
$app->match('/admin/exp/add/{idbio}', 'expController:addAction')->bind('addExp');
$app->match('/admin/exp/edit/{id}', 'expController:editAction')->bind('editExp');
$app->match('/admin/exp/delete', 'expController:deleteAction')->bind('deleteExp');

// Skill
$app->match('/admin/skill/add/{idbio}', 'skillController:addAction')->bind('addSkill');
$app->match('/admin/skill/edit/{id}', 'skillController:editAction')->bind('editSkill');
$app->match('/admin/skill/delete', 'skillController:deleteAction')->bind('deleteSkill');

// Interest
$app->match('/admin/interest/add/{idbio}', 'interestController:addAction')->bind('addInterest');
$app->match('/admin/interest/edit/{id}', 'interestController:editAction')->bind('editInterest');
$app->match('/admin/interest/delete', 'interestController:deleteAction')->bind('deleteInterest');

// Contact
$app->get('/admin/contact/list', 'contactController:listAction')->bind('listContact');
$app->match('/contact/add', 'contactController:addAction')->bind('addContact');
$app->match('/admin/contact/delete', 'contactController:deleteAction')->bind('deleteContact');

// User
$app->get('/admin/user/list', 'userController:listAction')->bind('listUser');
$app->match('/admin/user/add', 'userController:addAction')->bind('addUser');
$app->match('/admin/user/edit/{id}', 'userController:editAction')->bind('editUser');
$app->match('/admin/user/delete', 'userController:deleteAction')->bind('deleteUser');

// Static pages
$app->get('/mentions-legales', 'staticController:mentionslegalesAction')->bind('mentionslegalesStatic');
