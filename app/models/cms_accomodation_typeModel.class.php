<?php
class Cms_accomodation_typeModel extends Model{
	
	public function getDestinations(){
		
		$query = sprintf("SELECT * FROM `destinations` ORDER BY `name` ASC");
		return parent::query($query);
	}
	
	public function getAccomodationTypes(){
		
		$query = sprintf("SELECT `accomodation_types`.*, `destinations`.`name` AS `destination` FROM `accomodation_types` 
							INNER JOIN `destinations` ON `destinations`.`id`=`accomodation_types`.`destination_id`
							ORDER BY `accomodation_types`.`destination_id`, `accomodation_types`.`position_left` DESC");
		$res = mysql_query($query);
		if(mysql_num_rows($res) <= 0) return false;
		$output = array();
		
		while($row = mysql_fetch_assoc($res)){
			$output[$row['destination_id']][] = $row;
		}
		return $output;
	}
	
	public function getAccomodationType($params){
 		
 		$query = sprintf("SELECT * FROM `accomodation_types` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
		
		$row =  parent::queryOne($query);
		//Get transport
		$query_t = sprintf("SELECT `transport`.* FROM `transport` INNER JOIN `accomodation_type_transport`
								ON `accomodation_type_transport`.`transport_id`=`transport`.`id` WHERE
								`accomodation_type_transport`.`accomodation_type_id`='%s'",
							mysql_real_escape_string($params['id'])
							);
		$res_t = mysql_query($query_t);
		if(mysql_num_rows($res_t) > 0){
			$tmp_t = array();
			while($row_t = mysql_fetch_assoc($res_t)) $tmp_t[$row_t['id']] = $row_t; 
			$row = array_merge($row, array('transport' => $tmp_t));
		}
		
		$query_img = sprintf("SELECT * FROM `accomodation_type_images` WHERE `accomodation_type_id`='%s'",
							mysql_real_escape_string($params['id'])
							);
		$row = array_merge($row, array('additional' => parent::query($query_img)));
		return $row;
 	}
	
 	public function submit($params){
 		
 		if(isset($params['step']) && !empty($params['step'])){
			switch(strtolower($params['step'])){
				case 'first': 
					return $this->submitFirst($params);
				break;
				case 'second':
					return $this->submitSecond($params);
				break;
				case 'third':
					return $this->submitThird($params);
				break;
				default: return false;
			}
 		}else return $this->submitFirst($params);
 	}
 	
	private function submitFirst($params){
		
		if(isset($params['id']) && !empty($params['id'])){
			
			$query = sprintf("UPDATE `accomodation_types` SET 
							`name`='%s', `destination_id`='%s', 
							`desc`='%s', `desc_bottom`='%s', `gen_desc`='%s', 								`conditions`='%s',
							`web_desc`='%s', `web_keywords`='%s',
							`start`='%s', `from`='%s', `accomodation`='%s'
							WHERE `id`='%s'",
							mysql_real_escape_string($params['name']),
							mysql_real_escape_string($params['destination']),
							mysql_real_escape_string($params['desc']),
							mysql_real_escape_string($params['desc_bottom']),
							mysql_real_escape_string($params['gen_desc']),
							mysql_real_escape_string($params['conditions']),
							mysql_real_escape_string($params['web_desc']),
							mysql_real_escape_string($params['web_keywords']),
							mysql_real_escape_string($params['start']),
							mysql_real_escape_string($params['from']),
							mysql_real_escape_string($params['accomodation']),
							mysql_real_escape_string($params['id'])
							);
			mysql_query($query);
			
			//Update image if added
			if(isset($params['image']) && $params['image']['error'] == 0){
				
				$query_img = sprintf("UPDATE `accomodation_types` SET `image`='%s' WHERE `id`='%s'",
									mysql_real_escape_string($params['image']['name']),
									mysql_real_escape_string($params['id'])
									);
				mysql_query($query_img);
			}
			//Update pdf if added
			if(isset($params['pdf']) && $params['pdf']['error'] == 0){
				
				$query_img = sprintf("UPDATE `accomodation_types` SET `pdf`='%s' WHERE `id`='%s'",
									mysql_real_escape_string($params['pdf']['name']),
									mysql_real_escape_string($params['id'])
									);
				mysql_query($query_img);
			}
			
			$newId = $params['id'];
			
			//Insert into
			if(isset($params['transport']) && !empty($params['transport'])){
				//Remove those that are canceled
				$tmp_t = "";
				$c = 0;
				foreach($params['transport'] as $value) $tmp_t.= $value . (++$c<count($params['transport'])?",":"");
				
				$query_t = sprintf("DELETE FROM `accomodation_type_transport` WHERE 
										`accomodation_type_id`='%s' AND 
										`transport_id` NOT IN ('%s')",
									mysql_real_escape_string($newId),
									mysql_real_escape_string($tmp_t)
									);
				mysql_query($query_t);

				//Add new
				foreach($params['transport'] as $value){
					$query_t = sprintf("INSERT INTO `accomodation_type_transport` SET 
										`accomodation_type_id`='%s',
										`transport_id`='%s'",
										mysql_real_escape_string($newId),
										mysql_real_escape_string($value)
										);
					mysql_query($query_t);
				}
			}
			
			//Set link name
			$linkName = parent::getLinkName(array('name' => $params['name'], 'id' => $newId), 'accomodation_types');
			$queryLink = sprintf("UPDATE `accomodation_types` SET `link_name`='%s' WHERE `id`='%s'",
								mysql_real_escape_string($linkName),
								mysql_real_escape_string($newId)
								);
			parent::run($queryLink);
			
		}else{
			$position = 1;
			$query_position = sprintf("SELECT `position` FROM `accomodation_types` ORDER BY `position` DESC LIMIT 0, 1");
			$res_position = mysql_query($query_position);
			if(mysql_num_rows($res_position) > 0){
				$row_position = mysql_fetch_assoc($res_position);
				$position = $row_position['position'] + 1;
			}
			
			$position_left = 1;
			$query_position_left = sprintf("SELECT `position_left` FROM `accomodation_types` ORDER BY `position_left` DESC LIMIT 0, 1");
			$res_position_left = mysql_query($query_position_left);
			if(mysql_num_rows($res_position_left) > 0){
				$row_position_left = mysql_fetch_assoc($res_position_left);
				$position_left = $row_position_left['position_left'] + 1;
			}
			
			$query = sprintf("INSERT INTO `accomodation_types` SET 
							`name`='%s', `destination_id`='%s',
							`desc`='%s', `desc_bottom`='%s', 
							`gen_desc`='%s', `start`='%s', `from`='%s',
							`conditions`='%s', 
							`web_desc`='%s', `web_keywords`='%s', 															`image`='%s', 
							`pdf`='%s', `position`='%s', 
							`position_left`='%s', `accomodation`='%s'",
							mysql_real_escape_string($params['name']),
							mysql_real_escape_string($params['destination']),
							mysql_real_escape_string($params['desc']),
							mysql_real_escape_string($params['desc_bottom']),
							mysql_real_escape_string($params['gen_desc']),
							mysql_real_escape_string($params['start']),
							mysql_real_escape_string($params['from']),
							mysql_real_escape_string($params['conditions']),
							mysql_real_escape_string($params['web_desc']),
							mysql_real_escape_string($params['web_keywords']),
							mysql_real_escape_string(isset($params['image']['name'])?$params['image']['name']:''),
							mysql_real_escape_string(isset($params['pdf']['name'])?$params['pdf']['name']:''),
							mysql_real_escape_string($position),
							mysql_real_escape_string($position_left),
							mysql_real_escape_string($params['accomodation'])
							);
			$newId = parent::insert($query);
			//Insert into
			if(isset($params['transport']) && !empty($params['transport']))
				foreach($params['transport'] as $key => $value){
					$query_t = sprintf("INSERT INTO `accomodation_type_transport` SET 
										`accomodation_type_id`='%s',
										`transport_id`='%s'",
										mysql_real_escape_string($newId),
										mysql_real_escape_string($value)
										);
					mysql_query($query_t);
				}
			
			//Set link name
			$linkName = parent::getLinkName(array('name' => $params['name'], 'id' => $newId), 'accomodation_types');
			$queryLink = sprintf("UPDATE `accomodation_types` SET `link_name`='%s' WHERE `id`='%s'",
								mysql_real_escape_string($linkName),
								mysql_real_escape_string($newId)
								);
			parent::run($queryLink);
		}
		
		return $newId;		
 	}
 	
 	private function submitSecond($params){
 		
 		if(isset($params['id']) && !empty($params['id'])){
 			//Insert
 			if(isset($params['date']) && !empty($params['date']))
 				foreach($params['date'] as $key => $val){
 					$q = sprintf("INSERT INTO `accomodation_type_dates` SET `date`='%s', `nights`='%s',
 																			`accomodation_type_id`='%s'",
 								mysql_real_escape_string($val),
 								mysql_real_escape_string($params['nights'][$key]),
 								mysql_real_escape_string($params['id'])
 								);
 					mysql_query($q);
 				}
 				
 			return $params['id'];
 			
 		}else return false;
 	}
 	
 	private function submitThird($params){
 		
 		if(isset($params['id']) && !empty($params['id'])){
 			//BAD CODING 
 			
 			//Remove all from this category
 			$q_r = sprintf("DELETE FROM `accomodation_type_prices` WHERE `accomodation_type_id`='%s'",
 							mysql_real_escape_string($params['id'])
 							);
 			mysql_query($q_r);
 		}
 		//Add prices
 		foreach($params['price'] as $key => $val){
	 			$q = sprintf("INSERT INTO `accomodation_type_prices` SET `price`='%s',
	 										`accomodation_type_id`='%s',
	 										`transport_id`='%s'",
	 						mysql_real_escape_string($val),
	 						mysql_real_escape_string($params['id']),
	 						mysql_real_escape_string($key)
	 						);
	 						
	 			mysql_query($q);
 			}
 		
 		return true;
 	}
 	
 	public function getImages($params){
 		$query = sprintf("SELECT * FROM `accomodation_type_images` WHERE `accomodation_type_id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		return parent::query($query);
 	}
 	
 	public function manageFile($file, $id){
 		
 		//Add/edit additional images
		$query_img = sprintf("INSERT INTO `accomodation_type_images` SET `image`='%s', 
																		 `accomodation_type_id`='%s'",
							mysql_real_escape_string($file['name']),
							mysql_real_escape_string($id)
							);
							
		return parent::insert($query_img);
 	}
 	
	public function delete($params){
 		
 		$query = sprintf("DELETE FROM `accomodation_types` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		mysql_query($query);
 		return true;
 	}
 	
	public function deleteImage($params){
 		
 		$query = sprintf("UPDATE `accomodation_types` SET `image`='' WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		mysql_query($query);
 		return true;
 	}
 	
	public function deleteFile($params){
 		
 		$query = sprintf("UPDATE `accomodation_types` SET `pdf`='' WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		mysql_query($query);
 		return true;
 	}
 	
	public function deleteImageSecond($params){
 		
 		$query = sprintf("DELETE FROM `accomodation_type_images` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		mysql_query($query);
 		return true;
 	}
	
	public function getOldFileName($id){
		
		$query = sprintf("SELECT * FROM `accomodation_types` WHERE `id`='%s'",
						mysql_real_escape_string($id)
						);
		return parent::queryOne($query);
	}
	
	public function getOldFileNameSecond($id){
		
		$query = sprintf("SELECT * FROM `accomodation_type_images` WHERE `id`='%s'",
						mysql_real_escape_string($id)
						);
		return parent::queryOne($query);
	}
	
	public function getTransport(){
		
		$query = sprintf("SELECT * FROM `transport`");
		return parent::query($query);
	}
	
	public function getSelectedTransport($params){
		
		$query = sprintf("SELECT * FROM `transport` 
							INNER JOIN `accomodation_type_transport` ON
								`accomodation_type_transport`.`transport_id`=`transport`.`id`
								WHERE `accomodation_type_transport`.`accomodation_type_id`='%s'",
						mysql_real_escape_string($params['id'])
						);
		return parent::query($query);
	}
	
	public function getDates($params){
		/** HOT FIX - ADDING "ORDER BY `id` ASC" **/
		$query = sprintf("SELECT * FROM `accomodation_type_dates` WHERE `accomodation_type_id`='%s' ORDER BY `id` ASC",
						mysql_real_escape_string($params['id'])
						);
		return parent::query($query);
	}

	public function getSetDatePrices($params){
		
		$query = sprintf("SELECT * FROM `accomodation_type_prices` 
							WHERE `accomodation_type_id`='%s'",
						mysql_real_escape_string($params['id'])
						);
		$res = mysql_query($query);
		if(mysql_num_rows($res) <= 0) return false;
		$out = array();
		while($row = mysql_fetch_assoc($res)){
			$out[$row['transport_id']] = $row;
		}
		return $out;
	}
	
	public function deleteDate($params){
		
		$query = sprintf("DELETE FROM `accomodation_type_dates` WHERE `id`='%s'",
						mysql_real_escape_string($params['date_id'])
						);
		return parent::run($query);
	}
	
	public function setPosition($params){
		
		if(isset($params['dir']) && !empty($params['dir'])){
			switch($params['dir']){
				case 'up':
					$query_current = sprintf("SELECT * FROM `accomodation_types` WHERE `id`='%s' AND `destination_id`='%s'",
											mysql_real_escape_string($params['id']),
											mysql_real_escape_string($params['destination_id'])
											);
					$res_current = mysql_query($query_current);
					$row_current = mysql_fetch_assoc($res_current);
					$query_next = sprintf("SELECT * FROM `accomodation_types` WHERE 	`id`!='%s' AND 
																				`position_left`>'%s' AND
																				`destination_id`='%s'
																				ORDER BY `position_left` ASC
																				LIMIT 0, 1",
											mysql_real_escape_string($row_current['id']),
											mysql_real_escape_string($row_current['position_left']),
											mysql_real_escape_string($params['destination_id'])
											);
											
					$res_next = mysql_query($query_next);
					if(mysql_num_rows($res_next) <= 0) return true;
					$row_next = mysql_fetch_assoc($res_next);
					//Switch places
					$query_switch1 = sprintf("UPDATE `accomodation_types` SET `position_left`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_current['position_left']),
											mysql_real_escape_string($row_next['id'])
											);
					mysql_query($query_switch1);
					
					$query_switch2 = sprintf("UPDATE `accomodation_types` SET `position_left`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_next['position_left']),
											mysql_real_escape_string($row_current['id'])
											);
					mysql_query($query_switch2);
				break;
				case 'down':
					$query_current = sprintf("SELECT * FROM `accomodation_types` WHERE `id`='%s' AND `destination_id`='%s'",
											mysql_real_escape_string($params['id']),
											mysql_real_escape_string($params['destination_id'])
											);
					$res_current = mysql_query($query_current);
					$row_current = mysql_fetch_assoc($res_current);
					
					$query_prev = sprintf("SELECT * FROM `accomodation_types` WHERE 	`id`!='%s' AND 
																				`position_left`<'%s' AND
																				`destination_id`='%s' 
																				ORDER BY `position_left` DESC
																				LIMIT 0, 1",
											mysql_real_escape_string($row_current['id']),
											mysql_real_escape_string($row_current['position_left']),
											mysql_real_escape_string($params['destination_id'])
											); 
					$res_prev = mysql_query($query_prev);
					if(mysql_num_rows($res_prev) <= 0) return true;
					$row_prev = mysql_fetch_assoc($res_prev);
					//Switch places
					$query_switch1 = sprintf("UPDATE `accomodation_types` SET `position_left`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_current['position_left']),
											mysql_real_escape_string($row_prev['id'])
											);
					mysql_query($query_switch1);
					
					$query_switch2 = sprintf("UPDATE `accomodation_types` SET `position_left`='%s' WHERE `id`='%s'",
											mysql_real_escape_string($row_prev['position_left']),
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
