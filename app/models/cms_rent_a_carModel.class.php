<?php
class Cms_rent_a_carModel extends Model{
	
	public function submit($params){
	
		if(isset($params['id']) && !empty($params['id'])){
			
			$query = sprintf("UPDATE `rent_a_car` SET `type`='%s', `desc`='%s' WHERE `id`='%s'",
							mysql_real_escape_string($params['type']),
							mysql_real_escape_string($params['desc']),
							mysql_real_escape_string($params['id'])
							);
			mysql_query($query);
			
			//Update image if added
			if(isset($params['file']) && $params['file']['error'] == 0){
				
				$query_img = sprintf("UPDATE `rent_a_car` SET `image`='%s' WHERE `id`='%s'",
									mysql_real_escape_string($params['file']['name']),
									mysql_real_escape_string($params['id'])
									);
				mysql_query($query_img);
			}
			
			//Delete prices
			$query_price = sprintf("DELETE FROM `rent_a_car_prices` WHERE `rent_a_car_id`='%s'",
									mysql_real_escape_string($params['id'])
									);
			mysql_query($query_price);
			$newId = $params['id'];
		}else{
			$position = 1;
			$query_position = sprintf("SELECT `position` FROM `rent_a_car` ORDER BY `position` DESC LIMIT 0, 1");
			$res_position = mysql_query($query_position);
			if(mysql_num_rows($res_position) > 0){
				$row_position = mysql_fetch_assoc($res_position);
				$position = $row_position['position'] + 1;
			}
			$query = sprintf("INSERT INTO `rent_a_car` SET `type`='%s', `desc`='%s', `image`='%s', `position`='%s'",
							mysql_real_escape_string($params['type']),
							mysql_real_escape_string($params['desc']),
							mysql_real_escape_string(isset($params['file']['name'])?$params['file']['name']:''),
							mysql_real_escape_string($position)
							);
			$newId = parent::insert($query);
			
		}
		if(isset($params['price']) && !empty($params['price']))
			foreach($params['price'] as $key => $val){
				$query_price = sprintf("INSERT INTO `rent_a_car_prices` SET `price`='%s', `period`='%s', `rent_a_car_id`='%s'",
										mysql_real_escape_string($val),
										mysql_real_escape_string($params['period'][$key]),
										mysql_real_escape_string($newId)
										);
				mysql_query($query_price);
			}
		return $newId;
 	}
 	
 	public function getCars(){
 		$output = array();
 		
 		$query = sprintf("SELECT * FROM `rent_a_car` ORDER BY `position` DESC");
 		$res = mysql_query($query);
 		if(mysql_num_rows($res) <= 0)return false;
 		while($row = mysql_fetch_assoc($res)){ 
 			$query_prices = sprintf("SELECT * FROM `rent_a_car_prices` WHERE `rent_a_car_id`='%s' ORDER BY `id` DESC",
 									mysql_real_escape_string($row['id'])
 									);
 			$row['additional'] = parent::query($query_prices);
 			$output[] = $row;
 		}
 		return $output;
 	}
 	
	public function getCar($params){
 		$output = array();
 		$query = sprintf("SELECT * FROM `rent_a_car` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		$res = mysql_query($query);
		if(mysql_num_rows($res) <= 0) return false;
		while($row = mysql_fetch_assoc($res)){ 
 			$query_prices = sprintf("SELECT * FROM `rent_a_car_prices` WHERE `rent_a_car_id`='%s' ORDER BY `id` DESC",
 									mysql_real_escape_string($row['id'])
 									);
 			$row['additional'] = parent::query($query_prices);
 			$output[] = $row;
 		}
		return $output;
 	}
 	
	public function delete($params){
 		
 		$query = sprintf("DELETE FROM `rent_a_car` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		mysql_query($query);
 		return true;
 	}
 	
	public function deleteImage($params){
 		
 		$query = sprintf("UPDATE `rent_a_car` SET `image`='' WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		mysql_query($query);
 		return true;
 	}
 	
	public function setPosition($params){
		
		if(isset($params['dir']) && !empty($params['dir'])){
			switch($params['dir']){
				case 'up':
					$query_current = sprintf("SELECT * FROM `rent_a_car` WHERE `id`='%s'",
											mysql_real_escape_string($params['id'])
											);
					$res_current = mysql_query($query_current);
					$row_current = mysql_fetch_assoc($res_current);
					$query_next = sprintf("SELECT * FROM `rent_a_car` WHERE 		`id`!='%s' AND 
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
					$query_switch1 = sprintf("UPDATE `rent_a_car` SET `position`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_current['position']),
											mysql_real_escape_string($row_next['id'])
											);
					mysql_query($query_switch1);
					
					$query_switch2 = sprintf("UPDATE `rent_a_car` SET `position`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_next['position']),
											mysql_real_escape_string($row_current['id'])
											);
					mysql_query($query_switch2);
				break;
				case 'down':
					$query_current = sprintf("SELECT * FROM `rent_a_car` WHERE `id`='%s'",
											mysql_real_escape_string($params['id'])
											);
					$res_current = mysql_query($query_current);
					$row_current = mysql_fetch_assoc($res_current);
					
					$query_prev = sprintf("SELECT * FROM `rent_a_car` WHERE 	`id`!='%s' AND 
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
					$query_switch1 = sprintf("UPDATE `rent_a_car` SET `position`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_current['position']),
											mysql_real_escape_string($row_prev['id'])
											);
					mysql_query($query_switch1);
					
					$query_switch2 = sprintf("UPDATE `rent_a_car` SET `position`='%s' WHERE `id`='%s'",
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
	
	public function getOldFileName($id){
		
		$query = sprintf("SELECT * FROM `rent_a_car` WHERE `id`='%s'",
						mysql_real_escape_string($id)
						);
		return parent::queryOne($query);
	}
}