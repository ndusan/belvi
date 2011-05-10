<?php
class HomeModel extends Model{
	
	public function getAdditionalInfo($params, $tbl, $col){
		
		if($tbl == 'accomodation_types'){
			$query = sprintf("SELECT `accomodation_types`.`%s` AS `info` FROM `accomodation_types` WHERE `link_name`='%s'",
							mysql_real_escape_string($col),
							mysql_real_escape_string($params['name'])
							);
			return parent::queryOne($query);
		}elseif($tbl == 'accomodations'){
			$query = sprintf("SELECT `accomodations`.`%s` AS `info` FROM `accomodations`
								WHERE `accomodations`.`link_name`='%s'",
							mysql_real_escape_string($col),
							mysql_real_escape_string($params['name'])
							);
			return parent::queryOne($query);
			
		}
	}
	
	public function getHome(){
		$output = array();
		
		$query = sprintf("SELECT `destinations`.* FROM `destinations`
								INNER JOIN `accomodation_types` ON `accomodation_types`.`destination_id`=`destinations`.`id`
								WHERE `accomodation_types`.`visible`='1'
								GROUP BY `destinations`.`name`
								ORDER BY `accomodation_types`.`position` DESC");
							
		$rows = self::query($query);
		if(!$rows) return false;
		
		foreach($rows as $row){
			
			$q = sprintf("SELECT * FROM `accomodation_types`
							WHERE `destination_id`='%s' AND `visible`='1'",
						mysql_real_escape_string($row['id'])
						);
			$row['acc'] = self::query($q);
			
			$output[] = $row;
		}
		return $output;
	}
	
	public function getHotels($params){
		
		$query = sprintf("SELECT `accomodations`.`name` FROM `accomodations`
							LEFT JOIN `accomodation_types` ON `accomodation_types`.`id`=`accomodations`.`accomodation_type_id`
							WHERE `accomodation_types`.`id`='%s' GROUP BY `accomodations`.`name`",
						mysql_real_escape_string($params['id'])
						);
		return parent::query($query);
	}
}