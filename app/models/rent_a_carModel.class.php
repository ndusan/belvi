<?php
class Rent_a_carModel extends Model{
	
	public function getCars(){
 		$output = array();
 		
 		$query = sprintf("SELECT * FROM `rent_a_car` ORDER BY `position` DESC");
 		$res = mysql_query($query);
 		if(mysql_num_rows($res) <= 0)return false;
 		while($row = mysql_fetch_assoc($res)){ 
 			$query_prices = sprintf("SELECT * FROM `rent_a_car_prices` WHERE `rent_a_car_id`='%s' ORDER BY `id` DESC",
 									mysql_real_escape_string($row['id'])
 									);
 			$row['additional'] = parent::query($query_prices);
 			$output[] = $row;
 		}
 		return $output;
 	}
}