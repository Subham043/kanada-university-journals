<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Authentication';

$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;

//admin Authentication

$route['login'] = 'Authentication/index'; //login view
$route['can-login'] = 'Authentication/form_validation'; //check credential exist
$route['dashboard'] = 'Authentication/enter'; //open dashboard

$route['logout'] = 'Authentication/logout'; //logout

$route['otp-verification/(:any)']  	= 'Authentication/otp_verication/$1';


//forgot password

$route['forgot-password'] = 'Authentication/forgot_password'; //forgot password email check

$route['reset-password'] = 'Authentication/reset_password'; //forgot password email check

$route['set-password/(:any)'] = 'Authentication/add_pass/$1'; //forgot password email click

$route['update-password'] = 'Authentication/update_pass'; //forgot password email click

//change password

$route['change-password'] = 'Account/index'; //forgot password email click

$route['password/change'] = 'Account/password_validation'; //forgot password email click

