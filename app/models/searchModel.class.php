<?php

class SearchModel extends Model{

	
	public function getDestinations($params){
		
		$query = sprintf("SELECT id, name, destination_id FROM `accomodation_types` WHERE `destination_id`='%s' AND `name`!='#'",
						mysql_real_escape_string($params['id'])
						);
		return parent::query($query);
	}
	
	public function getResults($params){
		
		if(isset($params['s_accomodation_type_id']) && $params['s_accomodation_type_id'] > 0 && isset($params['s_transport_id']) && $params['s_transport_id'] > 0){
			$query = sprintf("SELECT `accomodations`.*,
								`accomodation_types`.`name` AS `accmodation_type`, `accomodation_types`.`accomodation`, `accomodation_types`.`link_name` AS `accomodation_type_link`
								FROM `accomodations` 
								INNER JOIN `accomodation_types` ON `accomodation_types`.`id`=`accomodations`.`accomodation_type_id`
								INNER JOIN `accomodation_type_transport` ON `accomodation_type_transport`.`accomodation_type_id`=`accomodation_types`.`id`
								WHERE 	`accomodation_types`.`id`='%s' AND
										`accomodation_type_transport`.`transport_id`='%s'",
							mysql_real_escape_string($params['s_accomodation_type_id']),
							mysql_real_escape_string($params['s_transport_id'])
							);
			
		}elseif(isset($params['s_accomodation_type_id']) && $params['s_accomodation_type_id'] > 0){
			$query = sprintf("SELECT `accomodations`.*,
								`accomodation_types`.`name` AS `accmodation_type`, `accomodation_types`.`accomodation`, `accomodation_types`.`link_name` AS `accomodation_type_link`
								FROM `accomodations` 
								INNER JOIN `accomodation_types` ON `accomodation_types`.`id`=`accomodations`.`accomodation_type_id`
								WHERE 	`accomodation_types`.`id`='%s'",
							mysql_real_escape_string($params['s_accomodation_type_id'])
							);
			
		}else return false;
		return parent::query($query);
	}
    
}