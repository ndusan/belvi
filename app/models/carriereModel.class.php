<?php
class CarriereModel extends Model{
	
	public function submit($params){
		
		$query = sprintf("INSERT INTO `carriere` SET `candidat`='%s', `position`='%s', `level`='%s',
													 `born`='%s',
													 `profession`='%s', `year`='%s', `expirience`='%s',
													 `reason`='%s', `features`='%s', `email`='%s',
													 `telephone`='%s'",
						mysql_real_escape_string($params['candidat']),
						mysql_real_escape_string($params['position']),
						mysql_real_escape_string($params['level']),
						mysql_real_escape_string($params['born']),
						mysql_real_escape_string($params['profession']),
						mysql_real_escape_string($params['year']),
						mysql_real_escape_string($params['expirience']),
						mysql_real_escape_string($params['reason']),
						mysql_real_escape_string($params['features']),
						mysql_real_escape_string($params['email']),
						mysql_real_escape_string($params['telephone'])
						);
		parent::insert($query);
		return true;
	}
	
	public function getPositions(){
		$query = sprintf("SELECT * FROM `positions` ORDER BY `modif` DESC");
		return parent::query($query);
	}
}