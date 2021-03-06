<?php defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'home';
$route['404_override'] = 'home/error_404';
$route['translate_uri_dashes'] = TRUE;


// admin routes
$route[ADMIN."/forgot-password"] = ADMIN."/login/forgot_password";
$route[ADMIN."/check-otp"] = ADMIN."/login/check_otp";
$route[ADMIN."/change-password"] = ADMIN."/login/change_password";
$route[ADMIN."/dashboard"] = ADMIN."/home";

// front routes
$route["about"] = "home/about";
$route["services"] = "home/services";
$route["gallery"] = "home/gallery";
$route["career"] = "home/career";
$route["faq"] = "home/faq";
$route["contact"] = "home/contact";
$route["apply"] = "home/apply";

if(strpos(PATH_INFOS, ADMIN) === false)
{
    $route["(:any)"] = "home/service/$1";
}