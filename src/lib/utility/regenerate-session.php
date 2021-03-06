<?php

/**
 * regenerate new session ID
 * Session ID must be regenerated when
 * User logged in
 * Certain period has passed
 * 
 * @return void
 * 
 */
function regenerate_session()
{

 if (session_status() != PHP_SESSION_ACTIVE) {
      
     session_start();

 }

 $newsid = session_id();

 $_SESSION['deleted_time'] = time() - Authentication::COOKIE_EXPIRE;

 session_write_close();

 session_id($newsid);

 session_start();

 session_regenerate_id();

}

function get_session_data($session_name = 'PHPSESSID', $session_save_handler = 'files')
{

 $session_data = array();

 if (array_key_exists($session_name, $_COOKIE)) {

    $session_id = $_COOKIE[$session_name];

    $old_session_id = session_id();

    session_write_close();

    $old_session_save_handler = ini_get('session.save_handler');

    ini_set('session.save_handler', $session_save_handler);

    $old_session_name = session_name($session_name);

    session_id($session_id);

    session_start();

    $session_data = $_SESSION;

    session_write_close();

    ini_set('session.save_handler', $old_session_save_handler);

    session_name($old_session_name);

    session_id($old_session_id);

    session_start();

 }

 return $session_data;

}

function clear_duplicate_cookies()
{

 if (headers_sent()) {

    return;

 }

 $cookies = array();

 foreach (headers_list() as $header) {

    if (strpos($header, 'Set-Cookie:') === 0) {

        $cookies[] = $header;

    }

 }

 header_remove('Set-Cookie');

 foreach (array_unique($cookies) as $cookie) {

    header($cookie, false);

 }
 
}