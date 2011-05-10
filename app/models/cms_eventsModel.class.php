<?php
class Cms_eventsModel extends Model{
	
	public function getEvents(){
		
		$query = sprintf("SELECT * FROM `events` ORDER BY `id` DESC");
		return parent::query($query);
	}
	
	public function getEvent($params){
 		
 		$query = sprintf("SELECT * FROM `events` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
		
		return parent::queryOne($query);
 	}
	
	public function submit($params){
		
		if(isset($params['id']) && !empty($params['id'])){
			
			$query = sprintf("UPDATE `events` SET `name`='%s', `place`='%s', `price`='%s', 
												  `date`='%s', `desc`='%s'
												  WHERE `id`='%s'",
							mysql_real_escape_string($params['name']),
							mysql_real_escape_string($params['place']),
							mysql_real_escape_string($params['price']),
							mysql_real_escape_string($params['date']),
							mysql_real_escape_string($params['desc']),
							mysql_real_escape_string($params['id'])
							);
			mysql_query($query);
			
			//Update image if added
			if(isset($params['file']) && $params['file']['error'] == 0){
				
				$query_img = sprintf("UPDATE `events` SET `image`='%s' WHERE `id`='%s'",
									mysql_real_escape_string($params['file']['name']),
									mysql_real_escape_string($params['id'])
									);
				mysql_query($query_img);
			}
			
			//Update image if added
			if(isset($params['pdf']) && $params['pdf']['error'] == 0){
				
				$query_img = sprintf("UPDATE `events` SET `pdf`='%s' WHERE `id`='%s'",
									mysql_real_escape_string($params['pdf']['name']),
									mysql_real_escape_string($params['id'])
									);
				mysql_query($query_img);
			}
			
			$newId = $params['id'];
		}else{
			$query = sprintf("INSERT INTO `events` SET `name`='%s', `place`='%s', `price`='%s',
													   `date`='%s', `desc`='%s', `image`='%s',
													   `pdf`='%s'",
							mysql_real_escape_string($params['name']),
							mysql_real_escape_string($params['place']),
							mysql_real_escape_string($params['price']),
							mysql_real_escape_string($params['date']),
							mysql_real_escape_string($params['desc']),
							mysql_real_escape_string(isset($params['file']['name'])?$params['file']['name']:''),
							mysql_real_escape_string(isset($params['pdf']['name'])?$params['pdf']['name']:'')
							);
			$newId = parent::insert($query);
			
		}
		return $newId;
 	}
 	
	public function delete($params){
 		
 		$query = sprintf("DELETE FROM `events` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		mysql_query($query);
 		return true;
 	}
 	
	public function deleteImage($params){
 		
 		$query = sprintf("UPDATE `events` SET `image`='' WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		mysql_query($query);
 		return true;
 	}
 	
	public function deleteFile($params){
 		
 		$query = sprintf("UPDATE `events` SET `pdf`='' WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		mysql_query($query);
 		return true;
 	}
	
	public function getOldFileName($id){
		
		$query = sprintf("SELECT * FROM `events` WHERE `id`='%s'",
						mysql_real_escape_string($id)
						);
		return parent::queryOne($query);
	}
	
	
	public function getOldPdfName($id){
		
		$query = sprintf("SELECT * FROM `events` WHERE `id`='%s'",
						mysql_real_escape_string($id)
						);
		return parent::queryOne($query);
	}
	
	public function setMain($params){
		//Reset to zero
		$query = sprintf("UPDATE `events` SET `main`='0'");
		mysql_query($query);
			
		$query = sprintf("UPDATE `events` SET `main`='1' WHERE `id`='%s'",
							mysql_real_escape_string($params['id'])
							);
		mysql_query($query);
		return true;
	}
	
	
}