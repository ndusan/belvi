<?php
class SummerController extends Controller{
	
	
	public function index($params){
		
		//Get all summer from cache
		if(!Cache::get(array('key' => 'accomodation_type_summer'))){
			$at = $this->db->getAccomodationTypesFront('summer');
			Cache::set(array('key' => 'accomodation_type_summer', 'data' => $at));
		}else $at = Cache::get(array('key' => 'accomodation_type_summer'));
		parent::set('summer', $at);
		
		//Active page
		parent::set('active', 'letovanja');
	}
	
	public function group($params){
		
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
		parent::set('active', 'letovanja');
		//Params
		parent::set('params', $params);

		parent::set('front', $this->db->getDescriptionAndKeywords('accomodation_types', $params['group']));
	}
	
	public function details($params){
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
		parent::set('active', 'letovanja');
		//Params
		parent::set('params', $params);

		parent::set('front', $this->db->getDescriptionAndKeywords('accomodations', $params['detail']));
	} 
}
