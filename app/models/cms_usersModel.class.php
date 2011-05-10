<?php
class Cms_usersModel extends Model{
	
	public function getUserById($params){
		
		$query = sprintf("SELECT * FROM `users` WHERE `id`='%s'",
						mysql_real_escape_string($params['id'])
						);
		return parent::query($query);
	}
	
	public function submit($params){
		
		if(isset($params['id']) && !empty($params['id'])){
			//Edit
			$query = sprintf("UPDATE `users` SET 	`firstname`='%s',
													`lastname`='%s'
								WHERE `id`='%s'",
							mysql_real_escape_string($params['firstname']),
							mysql_real_escape_string($params['lastname']),
							mysql_real_escape_string($params['id'])
			);
			mysql_query($query);
			
			//Check if there is a request for password
			if(isset($params['password']) && !empty($params['password'])){
				$query = sprintf("UPDATE `users` SET `password`=PASSWORD('%s') WHERE `id`='%s'",
								mysql_real_escape_string($params['password']),
								mysql_real_escape_string($params['id'])
								);
				mysql_query($query);
			}
		}else{
			//First check if there is user with email
			$query_check = sprintf("SELECT * FROM `users` WHERE `email`='%s'",
									mysql_real_escape_string($params['email'])
									);
			$res_check = mysql_query($query_check);
			if(mysql_num_rows($res_check) > 0) return false;
			
			$query = sprintf("INSERT INTO `users` SET 	`firstname`='%s',
														`lastname`='%s',
														`email`='%s',
														`password`=PASSWORD('%s')",
							mysql_real_escape_string($params['firstname']),
							mysql_real_escape_string($params['lastname']),
							mysql_real_escape_string($params['email']),
							mysql_real_escape_string($params['password'])
							);
			mysql_query($query);
		}
		return true;
	}
	
	public function getAllUsers(){
		
		$query = sprintf("SELECT * FROM `users`");
		return parent::query($query);
	}
	
	public function deleteUser($params){
		
		$query = sprintf("DELETE FROM `users` WHERE `id`='%s'",
						mysql_real_escape_string($params['id'])		
						);
		mysql_query($query);
		return true;
	}
}