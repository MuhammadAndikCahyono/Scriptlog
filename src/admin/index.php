<?php 
/**
 * File index.php
 * 
 * @category admin\index.php file
 * @author   M.Noermoehammad 
 * @license  https://opensource.org/licenses/MIT MIT License
 * 
 */
if (file_exists(__DIR__ . '/../config.sample.php')) {
    
    include __DIR__ . '/../lib/main-dev.php';
    require __DIR__ . '/authorizer.php';

    if ((isset($ubench)) && (true === APP_DEVELOPMENT)) {

         $ubench->start();

    }

} else {

    header("Location: ../install");
    exit();
       
}

if (!$isUserLoggedIn) {
   
   header("Location: login.php");
   exit();
   
} 

$user_id = isset($_COOKIE['cookie_user_id']) ? $_COOKIE['cookie_user_id'] : $_SESSION['user_id'];
$user_email = isset($_COOKIE['cookie_user_email']) ? $_COOKIE['cookie_user_email'] : $_SESSION['user_email'];
$user_level = isset($_COOKIE['cookie_user_level']) ? $_COOKIE['cookie_user_level'] : $_SESSION['user_level'];
$user_login = isset($_COOKIE['cookie_user_login']) ? $_COOKIE['cookie_user_login'] : $_SESSION['user_login'];
$user_session = user_info($authenticator, $user_login)['user_session'];
    
// BreadCrumbs
$breadCrumbs = isset($_GET['load']) ? htmlentities(sanitize_urls($_GET['load']), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : http_response_code();

// StylePath
$stylePath = $config['app']['url'] . APP_ADMIN;

// Current URL
$currentURL = APP_PROTOCOL . '://'. APP_HOSTNAME . dirname($_SERVER['PHP_SELF']) . DS;

// Allowed query
$allowedQuery = array('dashboard', 'posts', 'medialib',
                      'pages', 'topics', 'comments', 'templates', 
                      'menu', 'menu-child', 'users', 'settings', 
                      'plugins', 'logout', '403', '404');    

// retrieve plugin actived -- for administrator
$plugin_navigation = setplugin($user_level, 'private');

include 'admin-layout.php';

admin_header($stylePath, $breadCrumbs, $allowedQuery);

include 'navigation.php';

include 'request.php';

admin_footer($currentURL, $ubench);

ob_end_flush();
    
