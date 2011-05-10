<?php
class Cms_homeController extends Controller{
	
	public function index($params){
		//Check session user
		parent::userInfoAndSession();
		$e = $this->db->getAccomodationTypes();
		parent::set('types', $e);
		
		//Set page
		parent::set('active', 'home');
	}
	
	public function setVisible($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id']))
			$this->db->setVisible($params);
			
		parent::redirect('cms', 'success');
	}
	
	public function position($params){
		//Check session user
		parent::userInfoAndSession();
		
		if($this->db->setPosition($params)) parent::redirect('cms', '');
		else parent::redirect('cms', 'error');
	}

	public function carousel($params){
		//Check session user
		parent::userInfoAndSession();
		
		parent::set('carousel', $this->db->getCarousels());
		
		//Set page
		parent::set('active', 'home');
	}
	
	public function add($params){
		//Check session user
		parent::userInfoAndSession();
		
		parent::set('links', $this->db->getLinks());
		
		//Set page
		parent::set('active', 'home');
	}

	public function edit($params){
		//Check session user
		parent::userInfoAndSession();
		
		parent::set('carousel', $this->db->getCarousel($params));
		parent::set('links', $this->db->getLinks());
		
		parent::set('params', $params);
		//Set page
		parent::set('active', 'home');
	}
	
	public function submit($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['file']) && $params['file']['error'] == 0 && isset($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkImage($params['id']."-".$oldFileName['image'], 'carousel', false);
				
		}
		
		if($id = $this->db->submit($params)){
			if(isset($params['file']) && $params['file']['error'] == 0){
				parent::uploadAndResizeImage(744, 227, $params['file'], $id.'-'.$params['file']['name'], 'carousel');
			}
			parent::redirect('cms'.DS.'carousel', 'success');
		}else parent::redirect('cms'.DS.'carousel', 'error');
	}
	
	public function deleteImage($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkImage($params['id']."-".$oldFileName['image'], 'carousel', false);
		}
		
		if($this->db->deleteImage($params)) parent::redirect('cms'.DS.'carousel'.DS.$params['id'].DS.'edit', 'success');
		else parent::redirect('cms'.DS.'carousel'.DS.$params['id'].DS.'edit', 'error');
	}
	
	public function delete($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkImage($params['id']."-".$oldFileName['image'], 'carousel', false);
		}
		
		if($this->db->delete($params)) parent::redirect('cms'.DS.'carousel', 'success');
		else parent::redirect('cms'.DS.'carousel', 'error');
	}
	
	public function carouselPosition($params){
		//Check session user
		parent::userInfoAndSession();
		
		if($this->db->setPositionCarousel($params)) parent::redirect('cms'.DS.'carousel', '');
		else parent::redirect('cms'.DS.'carousel', 'error');
	}
	
}