<?php
/**
 * login attempt function
 *
 * @category function
 * @param string $ip
 * @return mixed
 * 
 */
function get_login_attempt($ip)
{
 
  $sql = "SELECT count(ip_address) AS failed_login_attempt 
          FROM tbl_login_attempt 
          WHERE ip_address = ? AND login_date BETWEEN DATE_SUB( NOW() , INTERVAL 1 DAY ) AND NOW()";

  $row = db_prepared_query($sql, [$ip])->get_result()->fetch_assoc();
  
  return $row;

}

function create_login_attempt($ip)
{
  
  $sql = "INSERT INTO tbl_login_attempt (ip_address, login_date) VALUES (?, NOW())";

  $stmt = db_prepared_query($sql, [$ip]);

  return $stmt;
  
}

function delete_login_attempt($ip)
{

   unset($_SESSION["captcha_code"]);

   $sql = "DELETE FROM tbl_login_attempt WHERE ip_address = ?";

   $removed = db_prepared_query($sql, [$ip]);

   return $removed;

}
