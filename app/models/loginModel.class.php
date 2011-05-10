<?php
class LoginModel extends Model{
	
	public function getUser($params){
		
		$query = sprintf("SELECT * FROM `users` WHERE `email`='%s' AND `password`=PASSWORD('%s')",
						mysql_real_escape_string($params['email']),
						mysql_real_escape_string($params['password'])
						);
		$res = mysql_query($query);
		if(mysql_num_rows($res) <= 0) return false;
		
		return mysql_fetch_assoc($res);
	}
	
	public function getUserFromCookie($token){
		
		$query = sprintf("SELECT * FROM `users` WHERE `token`='%s'",
						mysql_real_escape_string($token)
						);
		$res = mysql_query($query);
		if(mysql_num_rows($res) <= 0) return false;
		
		return mysql_fetch_assoc($res);
	}
	
	public function setLog($params, $server){
		
		$query = sprintf("INSERT INTO `logs` SET `ip_address`='%s', `client`='%s', `user_id`='%s'",
						mysql_real_escape_string($server['REMOTE_ADDR']),
						mysql_real_escape_string($server['HTTP_USER_AGENT']),
						mysql_real_escape_string($params['id'])
						);
		mysql_query($query);
		return true;
	}
}