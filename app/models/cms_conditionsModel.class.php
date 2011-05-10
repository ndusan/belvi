<?php
class Cms_conditionsModel extends Model{
	
	public function getConditions(){
		
		$query = sprintf("SELECT * FROM `conditions` ORDER BY `modif` DESC");
		return parent::queryOne($query);
	}
	
	
	public function submit($params){
	
		if(isset($params['id']) && !empty($params['id'])){
			
			$query = sprintf("UPDATE `conditions` SET `name`='%s' WHERE `id`='%s'",
							mysql_real_escape_string($params['name']),
							mysql_real_escape_string($params['id'])
							);
			mysql_query($query);
		}else{
			$query = sprintf("INSERT INTO `conditions` SET `name`='%s'",
							mysql_real_escape_string($params['name'])
							);
			mysql_query($query);
		}
		return true;
 	}
 	
	
}