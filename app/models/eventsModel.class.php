<?php
class EventsModel extends Model{
	
	public function getMainEvent(){
		
		$query = sprintf("SELECT * FROM `events` WHERE `main`='1'");
		
		return parent::queryOne($query);
	}
	
	public function getSelectedEvent($params){
		
		$query = sprintf("SELECT * FROM `events` WHERE `id`='%s'",
						mysql_real_escape_string($params['id'])
						);
		
		return parent::queryOne($query);
	}
	
	public function getCarouselImagesEvent($params){
		if(isset($params['id']) && !empty($params['id']))
			$query = sprintf("SELECT * FROM `events` WHERE `id`!='%s'",
							mysql_real_escape_string($params['id'])
							);
		else 
			$query = sprintf("SELECT * FROM `events` WHERE `main`='0'");
		return parent::query($query);
	}
}