<?php
class Online_bookingModel extends Model{
	
	public function submit($params){
		
		$query = sprintf("INSERT INTO `online_booking` SET `date_from`='%s', `date_to`='%s',
														   `destination`='%s', `accomodation`='%s',
														   `transport`='%s', `payment_method`='%s',
														   `address`='%s', `city`='%s',
														   `telephone`='%s', `email`='%s',
														   `reason`='%s'",
							mysql_real_escape_string($params['date_from']),
							mysql_real_escape_string($params['date_to']),
							mysql_real_escape_string($params['destination']),
							mysql_real_escape_string($params['accomodation']),
							mysql_real_escape_string($params['transport']),
							mysql_real_escape_string($params['payment_method']),
							mysql_real_escape_string($params['address']),
							mysql_real_escape_string($params['city']),
							mysql_real_escape_string($params['telephone']),
							mysql_real_escape_string($params['email']),
							mysql_real_escape_string($params['reason'])
						);
		$id = parent::insert($query);
		
		if(isset($params['parent']['name']) && !empty($params['parent']['name']))
			foreach($params['parent']['name'] as $key => $val){
				//Add parents and date of birth
				$query_parents = sprintf("INSERT INTO `online_booking_passangers` SET `online_booking_id`='%s',
																				      `passanger`='%s',
																				      `birth_date`='%s',
																				      `type`='%s'",
										mysql_real_escape_string($id),
										mysql_real_escape_string($val),
										mysql_real_escape_string($params['parent']['birth_date'][$key]),
										mysql_real_escape_string('Putnik')
										);
				parent::run($query_parents);
			}

			
		if(isset($params['child']['name']) && !empty($params['child']['name']))
			foreach($params['child']['name'] as $key => $val){
				//Add child and date of birth
				$query_child = sprintf("INSERT INTO `online_booking_passangers` SET `online_booking_id`='%s',
																				      `passanger`='%s',
																				      `birth_date`='%s',
																				      `type`='%s'",
										mysql_real_escape_string($id),
										mysql_real_escape_string($val),
										mysql_real_escape_string($params['child']['birth_date'][$key]),
										mysql_real_escape_string('Dete')
										);
				parent::run($query_child);
			}
			
		return true;
		
	}
	
	
	public function getAccomodationTypes(){
		
		$query = sprintf("SELECT * FROM `accomodation_types` WHERE `name`!='#'");
		return parent::query($query);
	}
	
	public function getHotels($params){
		
		$query = sprintf("SELECT * FROM `accomodations` WHERE `accomodation_type_id`='%s' GROUP BY `id`",
						mysql_real_escape_string($params['id'])
						);
		return parent::query($query);
	}
}