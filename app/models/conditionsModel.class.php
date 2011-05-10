<?php
class ConditionsModel extends Model{
	
	
	public function getConditions(){
		
		$query = sprintf("SELECT * FROM `conditions` ORDER BY `modif` DESC");
		return parent::queryOne($query);
	}
}