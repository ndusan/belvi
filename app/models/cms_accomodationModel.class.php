<?php
class Cms_accomodationModel extends Model{
	
	public function getEntry(){
		
		$query = sprintf("SELECT `accomodations`.*, `accomodation_types`.`name` AS `accomodation_type` 
							FROM `accomodations` 
							INNER JOIN `accomodation_types` ON `accomodation_types`.`id`=`accomodations`.`accomodation_type_id`
							ORDER BY `accomodations`.`id` DESC");
		return parent::query($query);
	}
	
	public function getAccomodationTypes(){
		
		$query = sprintf("SELECT * FROM `accomodation_types` ORDER BY `name` ASC");
		return parent::query($query);
	}
	
	public function getAccomodation($params){
 		
 		$query = sprintf("SELECT * FROM `accomodations` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
		
		$row =  parent::queryOne($query);
		
		$query_img = sprintf("SELECT * FROM `accomodation_images` WHERE `accomodation_id`='%s'",
							mysql_real_escape_string($params['id'])
							);
		$row = array_merge($row, array('additional' => parent::query($query_img)));
		return $row;
 	}
	
	public function getTypes(){
		
		$query = sprintf("SELECT * FROM `types` ORDER BY `name` ASC");
		return parent::query($query);
	}
	
	public function getServices(){
		
		$query = sprintf("SELECT * FROM `accomodation_services` ORDER BY `service` ASC");
		return parent::query($query);
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
			
			$query = sprintf("UPDATE `accomodations` SET 
							`name`='%s', `add`='%s', `accomodation_type_id`='%s',
							`type_id`='%s', `type_desc`='%s',
							`desc`='%s', `conditions`='%s',
							`web_desc`='%s', `web_keywords`='%s',
							`map`='%s', `code`='%s', `cat`='%s'
							WHERE `id`='%s'",
							mysql_real_escape_string($params['name']),
							mysql_real_escape_string($params['add']),
							mysql_real_escape_string($params['accomodation_type']),
							mysql_real_escape_string($params['type']),
							mysql_real_escape_string($params['type_desc']),
							mysql_real_escape_string($params['desc']),
							mysql_real_escape_string($params['conditions']),
							mysql_real_escape_string($params['web_desc']),
							mysql_real_escape_string($params['web_keywords']),
							mysql_real_escape_string($params['map']),
							mysql_real_escape_string($params['code']),
							mysql_real_escape_string($params['cat']),
							mysql_real_escape_string($params['id'])
							);
			mysql_query($query);
			
			$newId = $params['id'];
			
			//Set link name
			$linkName = parent::getLinkName(array('name' => $params['name'], 'id' => $newId), 'accomodations');
			$queryLink = sprintf("UPDATE `accomodations` SET `link_name`='%s' WHERE `id`='%s'",
								mysql_real_escape_string($linkName),
								mysql_real_escape_string($newId)
								);
			parent::run($queryLink);
			
		}else{
			$query = sprintf("INSERT INTO `accomodations` SET 
							`name`='%s', `add`='%s', `accomodation_type_id`='%s',
							`type_id`='%s', `type_desc`='%s',
							`desc`='%s', `conditions`='%s',
							`web_desc`='%s', `web_keywords`='%s',
							`map`='%s', `code`='%s', `cat`='%s'", 
							mysql_real_escape_string($params['name']),
							mysql_real_escape_string($params['add']),
							mysql_real_escape_string($params['accomodation_type']),
							mysql_real_escape_string($params['type']),
							mysql_real_escape_string($params['type_desc']),
							mysql_real_escape_string($params['desc']),
							mysql_real_escape_string($params['conditions']),
							mysql_real_escape_string($params['web_desc']),
							mysql_real_escape_string($params['web_keywords']),
							mysql_real_escape_string($params['map']),
							mysql_real_escape_string($params['code']),
							mysql_real_escape_string($params['cat'])
							);
			$newId = parent::insert($query);
		
			//Set link name
			$linkName = parent::getLinkName(array('name' => $params['name'], 'id' => $newId), 'accomodations');
			$queryLink = sprintf("UPDATE `accomodations` SET `link_name`='%s' WHERE `id`='%s'",
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
 			if(isset($params['acc']) && !empty($params['acc']))
 				foreach($params['acc'] as $key => $val){
 					$q = sprintf("INSERT INTO `accomodation_services` SET `service`='%s', `max_num`='%s',
 																			`num`='%s',
 																			`accomodation_id`='%s'",
 								mysql_real_escape_string($val),
 								mysql_real_escape_string($params['max_num'][$key]),
 								mysql_real_escape_string($params['num'][$key]),
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
 			$q_r = sprintf("DELETE FROM `accomodation_prices` WHERE `accomodation_id`='%s'",
 							mysql_real_escape_string($params['id'])
 							);
 			mysql_query($q_r);
 		}
 		//Add prices
 		foreach($params['price'] as $key => $val)
 			foreach($val as $k => $v){
	 			$q = sprintf("INSERT INTO `accomodation_prices` SET `price`='%s',
	 										`accomodation_id`='%s',
	 										`accomodation_service_id`='%s',
	 										`accomodation_type_date_id`='%s'",
	 						mysql_real_escape_string($v),
	 						mysql_real_escape_string($params['id']),
	 						mysql_real_escape_string($key),
	 						mysql_real_escape_string($k)
	 						);
	 			mysql_query($q);
 			}
 		
 		return true;
 	}
 	
	public function manageFile($file, $id){
 		
 		//Add/edit additional images
		$query_img = sprintf("INSERT INTO `accomodation_images` SET `image`='%s', 
													`accomodation_id`='%s'",
							mysql_real_escape_string($file['name']),
							mysql_real_escape_string($id)
							);
							
		return parent::insert($query_img);
 	}
 	
	public function getDates($params){
		
		/** HOT FIX - ADDING ORDER BY "`accomodation_type_dates`.`id` ASC" **/
		$query = sprintf("SELECT `accomodation_type_dates`.* FROM `accomodation_type_dates`
							LEFT JOIN `accomodation_types` ON `accomodation_types`.`id`=`accomodation_type_dates`.`accomodation_type_id`
							LEFT JOIN `accomodations` ON `accomodations`.`accomodation_type_id`=`accomodation_types`.`id` 
							WHERE `accomodations`.`id`='%s' ORDER BY `accomodation_type_dates`.`id` ASC",
						mysql_real_escape_string($params['id'])
						);
		return parent::query($query);
	}
	
	public function getOldFileName($params){
		
		$query = sprintf("SELECT * FROM `accomodation_images` WHERE `id`='%s'",
						mysql_real_escape_string($params['img_id'])
						);
		return parent::queryOne($query);
	}
	
	public function deleteImage($params){
 		
 		$query = sprintf("DELETE FROM `accomodation_images` WHERE `id`='%s'",
 						mysql_real_escape_string($params['img_id'])
 						);
 		mysql_query($query);
 		return true;
 	}
 	
	public function getSelectedServices($params){
		
		$query = sprintf("SELECT * FROM `accomodation_services` WHERE `accomodation_id`='%s'",
						mysql_real_escape_string($params['id'])
						);
		return parent::query($query);
	}
	
	public function deleteService($params){
		
		$query = sprintf("DELETE FROM `accomodation_services` WHERE `id`='%s'",
						mysql_real_escape_string($params['service_id'])
						);
		return parent::run($query);
	}
	
	public function getSetDateServices($params){
		
		$query = sprintf("SELECT * FROM `accomodation_prices` 
							WHERE `accomodation_id`='%s'",
						mysql_real_escape_string($params['id'])
						);
		$res = mysql_query($query);
		if(mysql_num_rows($res) <= 0) return false;
		$out = array();
		while($row = mysql_fetch_assoc($res)){
			$out[$row['accomodation_service_id']][$row['accomodation_type_date_id']] = $row;
		}
		return $out;
	}
	
	public function getImages($params){
 		$query = sprintf("SELECT * FROM `accomodation_images` WHERE `accomodation_id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		return parent::query($query);
 	}
 	
	public function delete($params){
 		
 		$query = sprintf("DELETE FROM `accomodations` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		mysql_query($query);
 		return true;
 	}
}
