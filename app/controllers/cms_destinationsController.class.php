<?php
class Cms_destinationsController extends Controller{
	
	public function index($params){
		//Check session user
		parent::userInfoAndSession();
		
		$d = $this->db->getDestinations();
		parent::set('destinations', $d);
		
		parent::set('active', 'destinations');
		parent::set('params', $params);
	}
	
	public function add($params){
		//Check session user
		parent::userInfoAndSession();
		
		parent::set('active', 'destinations');
		parent::set('params', $params);
	}
	
	public function edit($params){
		//Check session user
		parent::userInfoAndSession();
		
		$d = $this->db->getDestination($params);
		//Check for image of destination
		$dName = $this->db->getOldFileName($params['id']);
		$d = array_merge($d, array('image' => $dName['image']));
		parent::set('dest', $d);
		
		parent::set('active', 'destinations');
		parent::set('params', $params);
	}
	
	public function submit($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['file']) && $params['file']['error'] == 0 && isset($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkImage($params['id']."-".$oldFileName['image'], 'destinations', false);
		}
		if($id = $this->db->submit($params)){
			if(isset($params['file']) && $params['file']['error'] == 0){
					
				parent::uploadAndResizeImage(206, 38, $params['file'], $id.'-'.$params['file']['name'], 'destinations');
			}
				
			parent::redirect('cms'.DS.'destinations', 'success');
		} 
		else parent::redirect('cms'.DS.'destinations', 'error');
	}
	
	public function delete($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkImage($params['id']."-".$oldFileName['image'], 'destinations', false);
		}
		
		if($this->db->delete($params)) parent::redirect('cms'.DS.'destinations', 'success');
		else parent::redirect('cms'.DS.'destinations', 'error');
	}
	
	public function setVisible($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id']))
			$this->db->setVisible($params);
			
		parent::redirect('cms'.DS.'destinations', 'success');
	}
	
	public function position($params){
		//Check session user
		parent::userInfoAndSession();
		
		if($this->db->setPosition($params)) parent::redirect('cms'.DS.'destinations', '');
		else parent::redirect('cms'.DS.'destinations', 'error');
	}
}