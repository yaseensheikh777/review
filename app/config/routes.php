<?php 

$routes->add('/','UserController@login');
$routes->add('/login','UserController@login');
$routes->add('/forgot-password','UserController@forgotPassword');
$routes->add('/reset-password','UserController@resetPassword');
$routes->add('/admin/dashboard','UserController@adminDashboard');

$routes->add('/api/authorize','AuthController');
$routes->add('/api/order','OrderController');
$routes->add('/api/review','ReviewController');