<?php
class Cms_contactModel extends Model{
	
	public function submit($params){
	
		if(isset($params['id']) && !empty($params['id'])){
			
			$query = sprintf("UPDATE `locations` SET `location`='%s', `address`='%s', `map`='%s' WHERE `id`='%s'",
							mysql_real_escape_string($params['location']),
							mysql_real_escape_string($params['address']),
							mysql_real_escape_string($params['map']),
							mysql_real_escape_string($params['id'])
							);
			mysql_query($query);
		}else{
			$position = 1;
			$query_position = sprintf("SELECT `position` FROM `locations` ORDER BY `position` DESC LIMIT 0, 1");
			$res_position = mysql_query($query_position);
			if(mysql_num_rows($res_position) > 0){
				$row_position = mysql_fetch_assoc($res_position);
				$position = $row_position['position'] + 1;
			}
			$query = sprintf("INSERT INTO `locations` SET `location`='%s', `address`='%s', `map`='%s', `position`='%s'",
							mysql_real_escape_string($params['location']),
							mysql_real_escape_string($params['address']),
							mysql_real_escape_string($params['map']),
							mysql_real_escape_string($position)
							);
			mysql_query($query);
		}
		return true;
 	}
 	
 	public function getLocations(){
 		
 		$query = sprintf("SELECT * FROM `locations` ORDER BY `position` DESC");
 		return parent::query($query);
 	}
 	
	public function getLocation($params){
 		
 		$query = sprintf("SELECT * FROM `locations` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		$res = mysql_query($query);
		if(mysql_num_rows($res) <= 0) return false;
		return mysql_fetch_array($res);
 	}
 	
	public function delete($params){
 		
 		$query = sprintf("DELETE FROM `locations` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		mysql_query($query);
 		return true;
 	}
 	
	public function setPosition($params){
		
		if(isset($params['dir']) && !empty($params['dir'])){
			switch($params['dir']){
				case 'up':
					$query_current = sprintf("SELECT * FROM `locations` WHERE `id`='%s'",
											mysql_real_escape_string($params['id'])
											);
					$res_current = mysql_query($query_current);
					$row_current = mysql_fetch_assoc($res_current);
					$query_next = sprintf("SELECT * FROM `locations` WHERE 		`id`!='%s' AND 
																				`position`>'%s'
																				ORDER BY `position` ASC
																				LIMIT 0, 1",
											mysql_real_escape_string($row_current['id']),
											mysql_real_escape_string($row_current['position'])
											);
					$res_next = mysql_query($query_next);
					if(mysql_num_rows($res_next) <= 0) return true;
					$row_next = mysql_fetch_assoc($res_next);
					//Switch places
					$query_switch1 = sprintf("UPDATE `locations` SET `position`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_current['position']),
											mysql_real_escape_string($row_next['id'])
											);
					mysql_query($query_switch1);
					
					$query_switch2 = sprintf("UPDATE `locations` SET `position`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_next['position']),
											mysql_real_escape_string($row_current['id'])
											);
					mysql_query($query_switch2);
				break;
				case 'down':
					$query_current = sprintf("SELECT * FROM `locations` WHERE `id`='%s'",
											mysql_real_escape_string($params['id'])
											);
					$res_current = mysql_query($query_current);
					$row_current = mysql_fetch_assoc($res_current);
					
					$query_prev = sprintf("SELECT * FROM `locations` WHERE 	`id`!='%s' AND 
																				`position`<'%s' 
																				ORDER BY `position` DESC
																				LIMIT 0, 1",
											mysql_real_escape_string($row_current['id']),
											mysql_real_escape_string($row_current['position'])
											); 
					$res_prev = mysql_query($query_prev);
					if(mysql_num_rows($res_prev) <= 0) return true;
					$row_prev = mysql_fetch_assoc($res_prev);
					//Switch places
					$query_switch1 = sprintf("UPDATE `locations` SET `position`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_current['position']),
											mysql_real_escape_string($row_prev['id'])
											);
					mysql_query($query_switch1);
					
					$query_switch2 = sprintf("UPDATE `locations` SET `position`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_prev['position']),
											mysql_real_escape_string($row_current['id'])
											);
					mysql_query($query_switch2);
				break;
				default: //error
			}
		}else return false;
		
		return true;
	}
	

}