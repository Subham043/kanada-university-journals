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
$route['default_controller'] = 'Dashboard';

$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;

//admin Authentication

$route['login'] = 'Authentication/index'; //login view


$route['otp-verification/(:any)']  	= 'Authentication/otp_verication/$1';


//forgot password

$route['forgot-password'] = 'Authentication/forgot_password'; //forgot password email check

$route['reset-password/(:any)'] = 'Authentication/reset_password/$1'; //forgot password email check

//change password
// $route['dashboard'] = 'Account/dashboard'; //open dashboard

$route['profile'] = 'Account/profile'; //forgot password email click

$route['profile-change'] = 'Account/profile_update'; //forgot password email click
$route['password-change'] = 'Account/password_update'; //forgot password email click
$route['logout'] = 'Account/logout'; //logout

$route['/'] = 'Dashboard/index'; //logout
$route['dashboard'] = 'Dashboard/index'; //logout

//department
$route['admin/department/create'] = 'Department/create'; //open dashboard
$route['admin/department/edit/(:any)'] = 'Department/edit/$1'; //open dashboard
$route['admin/department/list'] = 'Department/lists'; //open dashboard
$route['admin/department/list/(:any)'] = 'Department/lists/$1'; //open dashboard
$route['admin/department/delete/(:any)'] = 'Department/delete/$1'; //open dashboard


//designation
$route['admin/designation/create'] = 'Designation/create'; //open dashboard
$route['admin/designation/edit/(:any)'] = 'Designation/edit/$1'; //open dashboard
$route['admin/designation/list'] = 'Designation/lists'; //open dashboard
$route['admin/designation/list/(:any)'] = 'Designation/lists/$1'; //open dashboard
$route['admin/designation/delete/(:any)'] = 'Designation/delete/$1'; //open dashboard

//keyword
$route['admin/keyword/create'] = 'Keyword/create'; //open dashboard
$route['admin/keyword/edit/(:any)'] = 'Keyword/edit/$1'; //open dashboard
$route['admin/keyword/list'] = 'Keyword/lists'; //open dashboard
$route['admin/keyword/list/(:any)'] = 'Keyword/lists/$1'; //open dashboard
$route['admin/keyword/delete/(:any)'] = 'Keyword/delete/$1'; //open dashboard

//publisher
$route['admin/publisher/create'] = 'Publisher/create'; //open dashboard
$route['admin/publisher/edit/(:any)'] = 'Publisher/edit/$1'; //open dashboard
$route['admin/publisher/list'] = 'Publisher/lists'; //open dashboard
$route['admin/publisher/list/(:any)'] = 'Publisher/lists/$1'; //open dashboard
$route['admin/publisher/delete/(:any)'] = 'Publisher/delete/$1'; //open dashboard

//teacher
$route['admin/teacher/create'] = 'Teacher/create'; //open dashboard
$route['admin/teacher/store'] = 'Teacher/store'; //open dashboard
$route['admin/teacher/edit/(:any)'] = 'Teacher/edit/$1'; //open dashboard
$route['admin/teacher/update/(:any)'] = 'Teacher/update/$1'; //open dashboard
$route['admin/teacher/list'] = 'Teacher/lists'; //open dashboard
$route['admin/teacher/list/(:any)'] = 'Teacher/lists/$1'; //open dashboard
$route['admin/teacher/delete/(:any)'] = 'Teacher/delete/$1'; //open dashboard
$route['admin/teacher/update/(:any)'] = 'Teacher/update/$1'; //open dashboard

$route['teacher'] = 'TeacherMain/lists'; //open dashboard
$route['teacher/(:any)'] = 'TeacherMain/lists/$1'; //open dashboard
$route['teacher/(:any)/journal-articles'] = 'TeacherMain/journal_articles/$1'; //open dashboard
$route['teacher/(:any)/book-articles'] = 'TeacherMain/book_articles/$1'; //open dashboard
$route['teacher/(:any)/journal'] = 'TeacherMain/journal/$1'; //open dashboard
$route['teacher/(:any)/book'] = 'TeacherMain/book/$1'; //open dashboard
$route['teacher/(:any)/conference-proceedings'] = 'TeacherMain/conference_proceedings/$1'; //open dashboard

//conference
$route['admin/conference/create'] = 'Conference/create'; //open dashboard
$route['admin/conference/store'] = 'Conference/store'; //open dashboard
$route['admin/conference/edit/(:any)'] = 'Conference/edit/$1'; //open dashboard
$route['admin/conference/update/(:any)'] = 'Conference/update/$1'; //open dashboard
$route['admin/conference/list'] = 'Conference/lists'; //open dashboard
$route['admin/conference/list/(:any)'] = 'Conference/lists/$1'; //open dashboard
$route['admin/conference/delete/(:any)'] = 'Conference/delete/$1'; //open dashboard

$route['conference-proceedings'] = 'ConferenceMain/lists'; //open dashboard
$route['conference-proceedings/(:any)'] = 'ConferenceMain/lists/$1'; //open dashboard

//book-article
$route['admin/book-article/create'] = 'BookArticle/create'; //open dashboard
$route['admin/book-article/store'] = 'BookArticle/store'; //open dashboard
$route['admin/book-article/edit/(:any)'] = 'BookArticle/edit/$1'; //open dashboard
$route['admin/book-article/update/(:any)'] = 'BookArticle/update/$1'; //open dashboard
$route['admin/book-article/list'] = 'BookArticle/lists'; //open dashboard
$route['admin/book-article/list/(:any)'] = 'BookArticle/lists/$1'; //open dashboard
$route['admin/book-article/delete/(:any)'] = 'BookArticle/delete/$1'; //open dashboard

$route['book-article'] = 'BookArticleMain/lists'; //open dashboard
$route['book-article/(:any)'] = 'BookArticleMain/lists/$1'; //open dashboard

//book
$route['admin/book/create'] = 'Book/create'; //open dashboard
$route['admin/book/store'] = 'Book/store'; //open dashboard
$route['admin/book/edit/(:any)'] = 'Book/edit/$1'; //open dashboard
$route['admin/book/update/(:any)'] = 'Book/update/$1'; //open dashboard
$route['admin/book/list'] = 'Book/lists'; //open dashboard
$route['admin/book/list/(:any)'] = 'Book/lists/$1'; //open dashboard
$route['admin/book/delete/(:any)'] = 'Book/delete/$1'; //open dashboard

$route['book'] = 'BookMain/lists'; //open dashboard
$route['book/(:any)'] = 'BookMain/lists/$1'; //open dashboard

//journal-article
$route['admin/journal-article/create'] = 'JournalArticle/create'; //open dashboard
$route['admin/journal-article/store'] = 'JournalArticle/store'; //open dashboard
$route['admin/journal-article/edit/(:any)'] = 'JournalArticle/edit/$1'; //open dashboard
$route['admin/journal-article/update/(:any)'] = 'JournalArticle/update/$1'; //open dashboard
$route['admin/journal-article/list'] = 'JournalArticle/lists'; //open dashboard
$route['admin/journal-article/list/(:any)'] = 'JournalArticle/lists/$1'; //open dashboard
$route['admin/journal-article/delete/(:any)'] = 'JournalArticle/delete/$1'; //open dashboard

$route['journal-article'] = 'JournalArticleMain/lists'; //open dashboard
$route['journal-article/(:any)'] = 'JournalArticleMain/lists/$1'; //open dashboard

//journal
$route['admin/journal/create'] = 'Journal/create'; //open dashboard
$route['admin/journal/store'] = 'Journal/store'; //open dashboard
$route['admin/journal/edit/(:any)'] = 'Journal/edit/$1'; //open dashboard
$route['admin/journal/update/(:any)'] = 'Journal/update/$1'; //open dashboard
$route['admin/journal/list'] = 'Journal/lists'; //open dashboard
$route['admin/journal/list/(:any)'] = 'Journal/lists/$1'; //open dashboard
$route['admin/journal/delete/(:any)'] = 'Journal/delete/$1'; //open dashboard

$route['journal'] = 'JournalMain/lists'; //open dashboard
$route['journal/(:any)'] = 'JournalMain/lists/$1'; //open dashboard