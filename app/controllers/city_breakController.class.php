<?php
class City_breakController extends Controller{
	
	public function index($params){
		
		//Get all summer from cache
		if(!Cache::get(array('key' => 'accomodation_type_city_break'))){
			$at = $this->db->getAccomodationTypesFront('city_break');
			Cache::set(array('key' => 'accomodation_type_city_break', 'data' => $at));
		}else $at = Cache::get(array('key' => 'accomodation_type_city_break'));
		parent::set('city_break', $at);
		
		//Active page
		parent::set('active', 'evropski-gradovi');
	}
	
	public function group($params){
		
		if($params['group'] == 'evropski-gradovi') $params['group'] = "evropski-gradovi";
		
		//Set top carousel
		$carousel = $this->db->getGroupsCarouselFront($params['group']);
		parent::set('carouselImage', $carousel);
		parent::set('carouselFolder', 'accomodation_type');
		parent::set('carouselAction', 'winter');
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
		parent::set('active', 'evropski-gradovi');
		//Params
		parent::set('params', $params);

		parent::set('front', $this->db->getDescriptionAndKeywords('accomodation_types', $params['group']));
	}
	
	public function details($params){
		
		if($params['group'] == 'evropski-gradovi') $params['group'] = "evropski-gradovi";
		
		//Set top carousel
		$carousel = $this->db->getGroupsCarouselDetails($params['detail']);
		parent::set('carouselImage', $carousel);
		parent::set('carouselFolder', 'accomodation');
		parent::set('carouselAction', 'winter');
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
		parent::set('active', 'evropski-gradovi');
		//Params
		parent::set('params', $params);
		
		parent::set('front', $this->db->getDescriptionAndKeywords('accomodations', $params['detail']));
	} 
	
}
