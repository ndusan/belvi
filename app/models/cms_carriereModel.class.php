<?php
class Cms_carriereModel extends Model{
	
	public function getCandidates(){
		
		$query = sprintf("SELECT * FROM `carriere` ORDER BY `modif` DESC");
		return parent::query($query);
	}
	
	
	public function delete($params){
		
		$query = sprintf("DELETE FROM `carriere` WHERE `id`='%s'",
						mysql_real_escape_string($params['id'])
						);
		return parent::run($query);
	}
	
	public function getPositions(){
		$query = sprintf("SELECT * FROM `positions` ORDER BY `modif` DESC");
		return parent::query($query);
	}
	
	public function getPosition($params){
 		
 		$query = sprintf("SELECT * FROM `positions` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
		return parent::queryOne($res);
 	}
	
	public function submit($params){
	
		if(isset($params['id']) && !empty($params['id'])){
			
			$query = sprintf("UPDATE `positions` SET `name`='%s' WHERE `id`='%s'",
							mysql_real_escape_string($params['name']),
							mysql_real_escape_string($params['id'])
							);
			mysql_query($query);
		}else{
			$query = sprintf("INSERT INTO `positions` SET `name`='%s'",
							mysql_real_escape_string($params['name'])
							);
			mysql_query($query);
		}
		return true;
 	}
 	
	public function deletePosition($params){
 		
 		$query = sprintf("DELETE FROM `positions` WHERE `id`='%s'",
 						mysql_real_escape_string($params['id'])
 						);
 		mysql_query($query);
 		return true;
 	}
	
}