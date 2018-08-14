<?php

$router->get('/', 'HomeController@index', 'homepage');
$router->get('/contact', 'ContactController@index', 'contact');