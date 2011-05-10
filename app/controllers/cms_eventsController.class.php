<?php
class Cms_eventsController extends Controller{
	
	public function index(){
	
		//Check session user
		parent::userInfoAndSession();
		$e = $this->db->getEvents();
		parent::set('events', $e);

		//Set page
		parent::set('active', 'events');
	}
	
	public function add($params){
		//Check session user
		parent::userInfoAndSession();
		
		//Set page
		parent::set('active', 'events');
	}
	
	public function edit($params){
		//Check session user
		parent::userInfoAndSession();
		
		$e = $this->db->getEvent($params);
		//Check for image of event
		$eName = $this->db->getOldFileName($params['id']);
		$e = array_merge($e, array('image' => $eName['image']));
		
		parent::set('event', $e); 
		//Set page
		parent::set('active', 'events');
		parent::set('params', $params);
	}
	
	public function submit($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['file']) && $params['file']['error'] == 0 && isset($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkImage($params['id']."-".$oldFileName['image'], 'events', true);
		}
		
		if(isset($params['pdf']) && $params['pdf']['error'] == 0 && isset($params['id'])){
			if($oldPdfName = $this->db->getOldPdfName($params['id']))
				parent::unlinkFile($params['id']."-pdf-".$oldPdfName['pdf'], 'events');
		}
		if($id = $this->db->submit($params)){
			if(isset($params['file']) && $params['file']['error'] == 0){
				parent::uploadAndResizeImage(486, 356, $params['file'], $id.'-'.$params['file']['name'], 'events', true);
			}
			
			if(isset($params['pdf']) && $params['pdf']['error'] == 0){
				parent::uploadFile($params['pdf'], $id.'-pdf-'.$params['pdf']['name'], 'events');
			}
				
			parent::redirect('cms'.DS.'events', 'success');
		} 
		else parent::redirect('cms'.DS.'events', 'error');
	}
	
	public function delete($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkImage($params['id']."-".$oldFileName['image'], 'events', true);

			if($oldPdfName = $this->db->getOldPdfName($params['id']))
				parent::unlinkFile($params['id']."-pdf-".$oldPdfName['pdf'], 'events');
		}
		
		if($this->db->delete($params)) parent::redirect('cms'.DS.'events', 'success');
		else parent::redirect('cms'.DS.'events', 'error');
	}
	
	public function deleteImage($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkImage($params['id']."-".$oldFileName['image'], 'events', true);
		}
		
		if($this->db->deleteImage($params)) parent::redirect('cms'.DS.'events'.DS.$params['id'].DS.'edit', 'success');
		else parent::redirect('cms'.DS.'events'.DS.$params['id'].DS.'edit', 'error');
	}
	
	public function deleteFile($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id'])){
			if($oldFileName = $this->db->getOldPdfName($params['id']))
				parent::unlinkFile($params['id']."-pdf-".$oldFileName['pdf'], 'events');
		}
		
		if($this->db->deleteFile($params)) parent::redirect('cms'.DS.'events'.DS.$params['id'].DS.'edit', 'success');
		else parent::redirect('cms'.DS.'events'.DS.$params['id'].DS.'edit', 'error');
	}
	
	public function setMain($params){
		//Check session user
		parent::userInfoAndSession();
		
		echo true;
		$this->db->setMain($params);
		
	}	
}