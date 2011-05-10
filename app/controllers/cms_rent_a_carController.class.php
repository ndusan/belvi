<?php
class Cms_rent_a_carController extends Controller{
	
	
	public function index(){
		
		//Check session user
		parent::userInfoAndSession();
		$cars = $this->db->getCars();
		
		parent::set('cars', $cars);
		//Set page
		parent::set('active', 'rent_a_car');
	}
	
	public function add($params){
		//Check session user
		parent::userInfoAndSession();
		
		//Set page
		parent::set('active', 'rent_a_car');
	}
	
	public function edit($params){
		//Check session user
		parent::userInfoAndSession();
		
		$car = $this->db->getCar($params);
		//Check for image of car
		$carName = $this->db->getOldFileName($params['id']);
		$car = array_merge($car, array('image' => $params['id'].'-'.$carName['image']));
		
		parent::set('car', $car); 
		//Set page
		parent::set('active', 'rent_a_car');
		parent::set('params', $params);
	}
	
	public function submit($params){
		//Check session user
		parent::userInfoAndSession();
		if(isset($params['file']) && $params['file']['error'] == 0 && isset($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkImage($params['id']."-".$oldFileName['image'], 'rent_a_car', false);
		}
		if($id = $this->db->submit($params)){
			if(isset($params['file']) && $params['file']['error'] == 0){
					
				parent::uploadAndResizeImage(300, 219, $params['file'], $id.'-'.$params['file']['name'], 'rent_a_car');
			}
				
			parent::redirect('cms'.DS.'rent_a_car', 'success');
		} 
		else parent::redirect('cms'.DS.'rent_a_car', 'error');
	}
	
	public function delete($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
			parent::unlinkImage($params['id']."-".$oldFileName['image'], 'rent_a_car', false);
		}
		if($this->db->delete($params)) parent::redirect('cms'.DS.'rent_a_car', 'success');
		else parent::redirect('cms'.DS.'rent_a_car', 'error');
	}
	
	public function deleteImage($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkImage($params['id']."-".$oldFileName['image'], 'rent_a_car', false);
		}
		
		if($this->db->deleteImage($params)) parent::redirect('cms'.DS.'rent_a_car'.DS.$params['id'].DS.'edit', 'success');
		else parent::redirect('cms'.DS.'rent_a_car'.DS.$params['id'].DS.'edit', 'error');
	}
	
	public function position($params){
		//Check session user
		parent::userInfoAndSession();
		
		if($this->db->setPosition($params)) parent::redirect('cms'.DS.'rent_a_car', '');
		else parent::redirect('cms'.DS.'rent_a_car', 'error');
	}
}