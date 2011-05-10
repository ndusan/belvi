<?php
class Online_bookingController extends Controller{
	
	
	public function index($params){
		
		parent::set('active', 'rezervacije');
		parent::set('at', $this->db->getAccomodationTypes());
		
		parent::defaultJs(array('online_booking', 'ui.datepicker'));
		parent::defaultCss(array('datepicker'));
	}
	
	public function submit($params){
		
		if($this->db->submit($params)){
			//send by email
			
			$data = array(	'Period putovanja ' 			=> 	$params['date_from']." - ".$params['date_to'],
							'Destinacija' 					=> 	$params['destination'],
							'Hotel/apartman'				=>	$params['accomodation'],
							'Prevozno sredstvo'				=>	$params['transport'],
							'Način plaćanja'				=>	$params['payment_method'],
							'Adresa'						=> 	$params['address'],
							'Mesto'							=>	$params['city'],
							'Kontakt telefon'				=>	$params['telephone'],
							'E-mail'						=>	$params['email'],
							'Napomena'						=>	$params['reason']
			);
			
			if(isset($params['parent']['name']) && !empty($params['parent']['name'])){
				$data = array_merge($data, array('Informacije o odraslim putnicima'=>''));
				$i = 0;
				foreach($params['parent']['name'] as $key => $val){
					$name = "Putnik ".++$i;
					$name2 = "Datum rodjenja putnika ". $i;
					$data = array_merge($data, array($name => $val));
					$data = array_merge($data, array($name2 => $params['parent']['birth_date'][$key]));
				}
			}
			if(isset($params['child']['name']) && !empty($params['child']['name'])){
				$data = array_merge($data, array('Informacije o deci'=>''));
				$i = 0;
				foreach($params['child']['name'] as $key => $val){
					$name = "Dete ".++$i;
					$name2 = "Datum rodjenja deteta ". $i;
					$data = array_merge($data, array($name => $val));
					$data = array_merge($data, array($name2 => $params['child']['birth_date'][$key]));
				}
			}
			
			parent::sendEmail(array('subject' => "Online booking", 'data' => $data, 'email' => 'office@belvi.rs'));
			
			parent::redirect('rezervacije', 'success');
		} 
		else parent::redirect('rezervacije', 'error');
	}
	
	public function getHotels($params){
		
		echo json_encode($this->db->getHotels($params));
	}
}