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


$route['otp-verification/(:any)']  	= 'Authentication/otp_verication/$1';


//forgot password

$route['forgot-password'] = 'Authentication/forgot_password'; //forgot password email check

$route['reset-password/(:any)'] = 'Authentication/reset_password/$1'; //forgot password email check

//change password
$route['dashboard'] = 'Account/dashboard'; //open dashboard

$route['profile'] = 'Account/profile'; //forgot password email click

$route['profile-change'] = 'Account/profile_update'; //forgot password email click
$route['password-change'] = 'Account/password_update'; //forgot password email click
$route['logout'] = 'Account/logout'; //logout

//department
$route['department/create'] = 'Department/create'; //open dashboard
$route['department/edit/(:any)'] = 'Department/edit/$1'; //open dashboard
$route['department/list/(:any)'] = 'Department/list/$1'; //open dashboard


//designation
$route['designation/create'] = 'Designation/create'; //open dashboard
$route['designation/edit/(:any)'] = 'Designation/edit/$1'; //open dashboard
$route['designation/list/(:any)'] = 'Designation/list/$1'; //open dashboard

//keyword
$route['keyword/create'] = 'Keyword/create'; //open dashboard
$route['keyword/edit/(:any)'] = 'Keyword/edit/$1'; //open dashboard
$route['keyword/list/(:any)'] = 'Keyword/list/$1'; //open dashboard

//publisher
$route['publisher/create'] = 'Publisher/create'; //open dashboard
$route['publisher/edit/(:any)'] = 'Publisher/edit/$1'; //open dashboard
$route['publisher/list/(:any)'] = 'Publisher/list/$1'; //open dashboard

//teacher
$route['teacher/create'] = 'Teacher/create'; //open dashboard
$route['teacher/store'] = 'Teacher/store'; //open dashboard
$route['teacher/edit/(:any)'] = 'Teacher/edit/$1'; //open dashboard
$route['teacher/update/(:any)'] = 'Teacher/update/$1'; //open dashboard
$route['teacher/list/(:any)'] = 'Teacher/list/$1'; //open dashboard

//conference
$route['conference/create'] = 'Conference/create'; //open dashboard
$route['conference/store'] = 'Conference/store'; //open dashboard
$route['conference/edit/(:any)'] = 'Conference/edit/$1'; //open dashboard
$route['conference/update/(:any)'] = 'Conference/update/$1'; //open dashboard
$route['conference/list/(:any)'] = 'Conference/list/$1'; //open dashboard