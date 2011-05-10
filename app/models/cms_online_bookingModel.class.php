<?php
class Cms_online_bookingModel extends Model{
	
	
	public function getOnlineBooking(){
		
		$output = array();
		$query = sprintf("SELECT * FROM `online_booking` ORDER BY `modif` DESC");
		$res = mysql_query($query);
		if(mysql_num_rows($res) <= 0) return false;
		while($row = mysql_fetch_assoc($res)){
				$query_tmp = sprintf("SELECT * FROM `online_booking_passangers` WHERE `online_booking_id`='%s'",
									mysql_real_escape_string($row['id'])
									);
				$row = array_merge($row, array('additional' =>parent::query($query_tmp)));
				$output[] = $row;
		}
		return $output;
	}
	
	public function delete($params){
		
		$query = sprintf("DELETE FROM `online_booking` WHERE `id`='%s'",
						mysql_real_escape_string($params['id'])
						);
		return parent::run($query);
	}
}