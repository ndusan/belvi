<?php
class Cms_contactController extends Controller{
	
	
	public function index($params){
		//Check session user
		parent::userInfoAndSession();
		
		parent::set('locations', $this->db->getLocations());
		
		
		//Set page
		parent::set('active', 'contact');
	}
	
	public function add($params){
		//Check session user
		parent::userInfoAndSession();
		
		//Set page
		parent::set('active', 'contact');
	}
	
	public function edit($params){
		//Check session user
		parent::userInfoAndSession();
		
		parent::set('contact', $this->db->getLocation($params));
		
		//Set page
		parent::set('active', 'contact');
	}
	
	public function submit($params){
		//Check session user
		parent::userInfoAndSession();
		
		if($this->db->submit($params)) parent::redirect('cms'.DS.'contact', 'success');
		else parent::redirect('cms'.DS.'contact', 'error');
	}
	
	public function delete($params){
		//Check session user
		parent::userInfoAndSession();
		
		if($this->db->delete($params)) parent::redirect('cms'.DS.'contact', 'success');
		else parent::redirect('cms'.DS.'contact', 'error');
	}
	
	public function position($params){
		//Check session user
		parent::userInfoAndSession();
		
		if($this->db->setPosition($params)) parent::redirect('cms'.DS.'contact', '');
		else parent::redirect('cms'.DS.'contact', 'error');
	}
}