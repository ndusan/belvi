<?php
class ContactController extends Controller{
	
	public function index($params){
		
		//Try to get locations from cache
		if($tmp = Cache::get(array('key' => 'contact'))){
			$locations = $tmp;
		}else{
			//Get data from database and set in cache and database
			$locations = $this->db->getLocations();
			Cache::set(array('key' => 'contact', 'data' => $locations));
		}

		parent::set('locations', $locations);
		
		parent::set('active', 'kontakt');
	}
}