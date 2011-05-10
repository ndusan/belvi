<?php
class DestinationController extends Controller{
	
	
	public function index($params){
		
		//Get all destination from cache
		if(!Cache::get(array('key' => 'accomodation_type_destination'))){
			$at = $this->db->getAccomodationTypesFront('destination');
			Cache::set(array('key' => 'accomodation_type_destination', 'data' => $at));
		}else $at = Cache::get(array('key' => 'accomodation_type_destination'));
		parent::set('summer', $at);
		
		//Active page
		parent::set('active', 'destination');
	}
	
	public function group($params){
		
		//Set top carousel
		$carousel = $this->db->getGroupsCarouselFront($params['group']);
		parent::set('carouselImage', $carousel);
		parent::set('carouselFolder', 'accomodation_type');
		parent::set('carouselAction', 'destination');
		parent::set('carouselPage', 'accomodation_type_id');
		
		//Main table
		if(!Cache::get(array('key' => 'accType'.$params['group']))){
			$output = $this->db->getAccType($params);
			Cache::set(array('key' => 'accType'.$params['group'], 'data' => $output));
		}else $output = Cache::get(array('key' => 'accType'.$params['group']));
		parent::set('accType', $output);
		
		//Accomodations
		if(!Cache::get(array('key' => 'accom'.$params['group']))){
			$output = $this->db->getAcc($params);
			Cache::set(array('key' => 'accom'.$params['group'], 'data' => $output));
		}else $output = Cache::get(array('key' => 'accom'.$params['group']));
		parent::set('accom', $output);
		
		//Active page
		parent::set('active', 'destination');
		//Params
		parent::set('params', $params);
	}
	
	public function details($params){
		//Set top carousel
		$carousel = $this->db->getGroupsCarouselDetails($params['detail']);
		parent::set('carouselImage', $carousel);
		parent::set('carouselFolder', 'accomodation');
		parent::set('carouselAction', 'destination');
		parent::set('carouselPage', 'accomodation_id');
		
		//Main table
		if(!Cache::get(array('key' => 'accType'.$params['group']))){
			$output = $this->db->getAccType($params);
			Cache::set(array('key' => 'accType'.$params['group'], 'data' => $output));
		}else $output = Cache::get(array('key' => 'accType'.$params['group']));
		parent::set('accType', $output);
		
		//Accomodation
		if(!Cache::get(array('key' => 'oneAccom'.$params['detail']))){
			$output = $this->db->getOneAcc($params);
			Cache::set(array('key' => 'oneAccom'.$params['detail'], 'data' => $output));
		}else $output = Cache::get(array('key' => 'oneAccom'.$params['detail']));
		parent::set('accom', $output);
		
		//Active page
		parent::set('active', 'destination');
		//Params
		parent::set('params', $params);
	} 
}