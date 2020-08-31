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
$route['default_controller'] = 'Analytics_controller';
$route['general'] = 'Analytics_controller/index';
$route['payments'] = 'Analytics_controller/payments';
$route['payment_reports'] = 'AppAnalytics/payment_reports';
$route['web'] ='Web_controller/webAnalytics';
$route['videoViewers'] ='Web_controller/videoViewers';
$route['bookReaders'] ='Web_controller/bookReaders';
$route['attempted_payments'] ='Web_controller/payments';
$route['app'] = 'AppAnalytics/index';
$route['evaluations'] = 'Evaluations_controller/evaluations';
$route['examsAttemptsToday'] = 'Evaluations_controller/examsAttemptsToday';
$route['examAttempts'] = 'Evaluations_controller/examAttempts';
$route['logins'] = 'Web_controller/logins';
$route['tiles'] = 'Payments/tiles';//api
$route['graphs'] ='Payments/graphs';//api
$route['authentication'] = 'Analytics_controller/authentication';
$route['login'] = 'Analytics_controller/login';
$route['logout'] = 'Analytics_controller/logout';
$route['accounts'] = 'Analytics_controller/accounts';
$route['accountsByDay'] = 'Analytics_controller/accountsByDay';
$route['filter'] = 'Analytics_controller/filterSignups';
$route['weeklyUsers'] = 'Analytics_controller/weeklyActiveUsers';
$route['monthlyUsers'] = 'Analytics_controller/monthlyActiveUsers';
$route['accountsview'] = "Analytics_controller/accountsByDay";
$route['accountsByDay'] = "Analytics_controller/signUps_by_Day";//ajax
$route['videos'] = "AppAnalytics/videos";
$route['ebooks'] = "AppAnalytics/ebooks";
$route['payers'] = "Analytics_controller/payers";
$route['users/(:num)'] = "AppAnalytics/users/$1";
$route['signins'] ="AppAnalytics/signins";
$route['schools']= "Schools/usage";
$route['schools/(:any)'] = "Schools/students/$1";
$route['unique']= "AppAnalytics/duplicates";
$route['reg_schools'] = "Schools/reg_schools";
$route['paid_schools'] = "Schools/paid_schools";
$route['top_reading'] = "Schools/top_reading";
$route['schools/users/(:any)'] = "Schools/users/$1";
$route['webData'] = 'Web_controller/webData';
$route['agents'] = 'Agents/agentsView';
$route['add_user'] = 'Agents/createAccountView';
$route['createAccount'] = 'Agents/createAccount';
$route['referrals/(:any)'] = 'Agents/referalByAgents/$1';
$route['broadcasts'] = 'Broadcasts/messages';
$route['broadcastEmail'] = 'Broadcasts/broadcastEmail';
$route['broadcastSMS'] = 'Broadcasts/broadcastSMS';
$route['email'] = 'Broadcasts/loadEmail';
$route['notify'] = 'Email_notifications/notifications';
$route['searchView'] = 'Search/searchView';
$route['search'] = 'Search/search';
$route['updateSub'] = 'Search/updateSubscription';
$route['repeatCustomers'] = 'AppAnalytics/repeatCustomers';
$route['info/(:any)']='AppAnalytics/repeatCustomersInfo/$1';

$route['appData']='AppAnalytics/AppData';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//payjoy
$route['getDevice'] = "PayJoy/payjoy_check_device";
$route['lock'] = "PayJoy/payjoy_lock_device";
$route['unlock'] = "PayJoy/payjoy_unlock_device";
$route['deactivate'] = "PayJoy/payjoy_deactivate_device";
$route['activate'] = "PayJoy/payjoy_activate_device";

