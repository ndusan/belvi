<?php
class Cms_destinationsModel extends Model{
	
	public function submit($params){
		
		if(isset($params['id']) && !empty($params['id'])){
			
			$query = sprintf("UPDATE `destinations` SET `name`='%s', `desc`='%s'
												  WHERE `id`='%s'",
							mysql_real_escape_string($params['name']),
							mysql_real_escape_string($params['desc']),
							mysql_real_escape_string($params['id'])
							);
			mysql_query($query);
			
			//Update image if added
			if(isset($params['file']) && $params['file']['error'] == 0){
				
				$query_img = sprintf("UPDATE `destinations` SET `image`='%s' WHERE `id`='%s'",
									mysql_real_escape_string($params['file']['name']),
									mysql_real_escape_string($params['id'])
									);
				mysql_query($query_img);
			}
			
			$newId = $params['id'];
		}else{
			$position = 1;
			$query_position = sprintf("SELECT `position` FROM `destinations` ORDER BY `position` DESC LIMIT 0, 1");
			$res_position = mysql_query($query_position);
			if(mysql_num_rows($res_position) > 0){
				$row_position = mysql_fetch_assoc($res_position);
				$position = $row_position['position'] + 1;
			}
			$query = sprintf("INSERT INTO `destinations` SET `name`='%s', `desc`='%s', `image`='%s', `position`='%s'",
							mysql_real_escape_string($params['name']),
							mysql_real_escape_string($params['desc']),
							mysql_real_escape_string(isset($params['file']['name'])?$params['file']['name']:''),
							mysql_real_escape_string($position)
							);
			$newId = parent::insert($query);
			
		}
		return $newId;
 	}
	
	public function getOldFileName($id){
		
		$query = sprintf("SELECT * FROM `destinations` WHERE `id`='%s'",
						mysql_real_escape_string($id)
						);
		return parent::queryOne($query);
	}
	
	public function getDestinations(){
		
		$query = sprintf("SELECT * FROM `destinations` ORDER BY `position` DESC");
		return parent::query($query);
	}
	

	public function getDestination($params){
 		
 		$query = sprintf("SELECT * FROM `destinations` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
		
		return parent::queryOne($query);
 	}
 	
	public function delete($params){
 		
 		$query = sprintf("DELETE FROM `destinations` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		mysql_query($query);
 		return true;
 	}
 	
 	public function setVisible($params){
 		
 		$query = sprintf("SELECT * FROM `destinations` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		$row = parent::queryOne($query);
 		
 		//Change visible status
 		$query = sprintf("UPDATE `destinations` SET `visible`='%s' WHERE `id`='%s'",
 						mysql_real_escape_string(1 - $row['visible']),
 						mysql_real_escape_string($params['id'])
 						);
 		parent::run($query);
 		return true;
 	}
 	
	public function setPosition($params){
		
		if(isset($params['dir']) && !empty($params['dir'])){
			switch($params['dir']){
				case 'up':
					$query_current = sprintf("SELECT * FROM `destinations` WHERE `id`='%s'",
											mysql_real_escape_string($params['id'])
											);
					$res_current = mysql_query($query_current);
					$row_current = mysql_fetch_assoc($res_current);
					$query_next = sprintf("SELECT * FROM `destinations` WHERE 	`id`!='%s' AND 
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
					$query_switch1 = sprintf("UPDATE `destinations` SET `position`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_current['position']),
											mysql_real_escape_string($row_next['id'])
											);
					mysql_query($query_switch1);
					
					$query_switch2 = sprintf("UPDATE `destinations` SET `position`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_next['position']),
											mysql_real_escape_string($row_current['id'])
											);
					mysql_query($query_switch2);
				break;
				case 'down':
					$query_current = sprintf("SELECT * FROM `destinations` WHERE `id`='%s'",
											mysql_real_escape_string($params['id'])
											);
					$res_current = mysql_query($query_current);
					$row_current = mysql_fetch_assoc($res_current);
					
					$query_prev = sprintf("SELECT * FROM `destinations` WHERE 	`id`!='%s' AND 
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
					$query_switch1 = sprintf("UPDATE `destinations` SET `position`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_current['position']),
											mysql_real_escape_string($row_prev['id'])
											);
					mysql_query($query_switch1);
					
					$query_switch2 = sprintf("UPDATE `destinations` SET `position`='%s' WHERE `id`='%s'",
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