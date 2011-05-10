<?php
class Cms_accomodation_typeController extends Controller{

	
	public function index(){
	
		//Check session user
		parent::userInfoAndSession();
		$e = $this->db->getAccomodationTypes();
		parent::set('types', $e);

		//Set page
		parent::set('active', 'accomodation_type');
	}
	
	public function add($params){
		//Check session user
		parent::userInfoAndSession();

		if(isset($params['step']) && !empty($params['step'])){
			switch(strtolower($params['step'])){
				case 'first':
					parent::set('destination', $this->db->getDestinations());
					parent::set('transport', $this->db->getTransport());
				break;
				case 'second':
					parent::defaultJs(array('ui.datepicker'));
					parent::defaultCss(array('datepicker'));	
				break;
				case 'third':
					parent::set('transport', $this->db->getSelectedTransport($params));
					parent::set('dates', $this->db->getDates($params));
				break;
				default: 
			}
		}else{
			
			parent::set('destination', $this->db->getDestinations());
			parent::set('transport', $this->db->getTransport());
		}
		//Set page
		parent::set('active', 'accomodation_type');
		//Set action
		$params = array_merge($params, array('action' => 'add'));
		parent::set('params', $params);
	}
	
	public function edit($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['step']) && !empty($params['step'])){
			switch(strtolower($params['step'])){
				case 'first':
					$e = $this->db->getAccomodationType($params);
					//Check for image of event
					$eName = $this->db->getOldFileName($params['id']);
					$e = array_merge($e, array('image' => $eName['image']));
					
					parent::set('type', $e); 
					parent::set('destination', $this->db->getDestinations());
					parent::set('transport', $this->db->getTransport());
				break;
				case 'second':
					parent::defaultJs(array('ui.datepicker'));
					parent::defaultCss(array('datepicker'));
					parent::set('output', $this->db->getDates($params));	
				break;
				case 'third':
					parent::set('transport', $this->db->getSelectedTransport($params));
					parent::set('price', $this->db->getSetDatePrices($params));
				break;
				default: 
			}
		}else{
			
			$e = $this->db->getAccomodationType($params);
			//Check for image of event
			$eName = $this->db->getOldFileName($params['id']);
			$e = array_merge($e, array('image' => $eName['image']));
			
			parent::set('type', $e); 
			parent::set('destination', $this->db->getDestinations());
			parent::set('transport', $this->db->getTransport());
		}
		
		//Set page
		parent::set('active', 'accomodation_type');
		
		//Set action
		$params = array_merge($params, array('action' => 'edit'));
		parent::set('params', $params);
	}
	
	/**
	 * Main submit
	 * Enter description here ...
	 * @param unknown_type $params
	 */
	public function submit($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['step']) && !empty($params['step']))
			switch(strtolower($params['step'])){
				case 'first': 
					$this->submitFirst($params);
				break;
				case 'second':
					$this->submitSecond($params);
				break;
				case 'third':
					$this->submitThird($params);
				break;
				default: parent::redirect('cms'.DS.'accomodation_type', 'error');
			}
		else $this->submitFirst($params);
	}
	
	private function submitFirst($params){
		
		if(isset($params['image']) && $params['image']['error'] == 0 && isset($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkImage($params['id']."-".$oldFileName['image'], 'accomodation_type', true);
		}
		
		//Remove PDF if added new
		if(isset($params['pdf']) && $params['pdf']['error'] == 0 && isset($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkFile($params['id']."-".$oldFileName['fdf'], 'accomodation_type');
		}
		
		if($id = $this->db->submit($params)){
			
			if(isset($params['image']) && $params['image']['error'] == 0){
				
				parent::uploadAndResizeImage(227, 100, $params['image'], $id.'-'.$params['image']['name'], 'accomodation_type', true);
			}
			if(isset($params['pdf']) && $params['pdf']['error'] == 0){
				
				parent::uploadFile($params['pdf'], $id.'-'.$params['pdf']['name'], 'accomodation_type');
			}
		
			//Upload files if
			if(isset($params['count']) && $params['count'] > 0){
				for($i=1; $i<=$params['count']; $i++){
					
					if(isset($params['file-' . $i]) && $params['file-' . $i]['error'] == 0){
						
						$tmpId = $this->db->manageFile($params['file-' . $i], $id);
						
						parent::uploadAndResizeImage(205, 150, $params['file-' . $i], $id.'-'.$tmpId.'-'.$params['file-' . $i]['name'], 'accomodation_type', true);
					}
				}
			}
			
			parent::redirectCustom('cms'.DS.'accomodation_type'.DS.$params['action'], array('id' => $id, 'step' => 'second'));
		}else parent::redirect('cms'.DS.'accomodation_type'.DS.$params['action'], 'error');
	}
	
	private function submitSecond($params){

		if($id = $this->db->submit($params))
			parent::redirectCustom('cms'.DS.'accomodation_type'.DS.$params['action'], array('id' => $id, 'step' => 'third'));
		else 
			parent::redirect('cms'.DS.'accomodation_type'.DS.$params['action'], 'error');
	}

	private function submitThird($params){

		if($this->db->submit($params))
			parent::redirect('cms'.DS.'accomodation_type', 'success');
		else 
			parent::redirect('cms'.DS.'accomodation_type'.DS.$params['action'], 'error');
	}
	
	public function delete($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkImage($params['id']."-".$oldFileName['image'], 'accomodation_type', true);
		}
		if($images = $this->db->getImages($params)){
			foreach ($images as $i)
				parent::unlinkImage($i['accomodation_type_id']."-".$i['id']."-".$i['image'], 'accomodation_type', true);
		}
		
		if($this->db->delete($params)) parent::redirect('cms'.DS.'accomodation_type', 'success');
		else parent::redirect('cms'.DS.'accomodation_type', 'error');
	}
	
	public function deleteImage($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkImage($params['id']."-".$oldFileName['image'], 'accomodation_type', true);
		}
		
		if($this->db->deleteImage($params)) parent::redirect('cms'.DS.'accomodation_type'.DS.$params['id'].DS.'edit', 'success');
		else parent::redirect('cms'.DS.'accomodation_type'.DS.$params['id'].DS.'edit', 'error');
	}
	
	public function deleteFile($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params['id']))
				parent::unlinkFile($params['id']."-".$oldFileName['pdf'], 'accomodation_type');
		}
		
		if($this->db->deleteFile($params)) parent::redirect('cms'.DS.'accomodation_type'.DS.$params['id'].DS.'edit', 'success');
		else parent::redirect('cms'.DS.'accomodation_type'.DS.$params['id'].DS.'edit', 'error');
	}
	
	public function deleteImageSecond($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id'])){
			if($oldFileName = $this->db->getOldFileNameSecond($params['id']))
				parent::unlinkImage($oldFileName['accomodation_type_id'].'-'.$params['id']."-".$oldFileName['image'], 'accomodation_type', true);
		}
		
		if($this->db->deleteImageSecond($params)) parent::redirect('cms'.DS.'accomodation_type'.DS.$oldFileName['accomodation_type_id'].DS.'edit', 'success');
		else parent::redirect('cms'.DS.'accomodation_type', 'error');
	}
	
	public function deleteDate($params){
		//Check session user
		parent::userInfoAndSession();
		
		if($this->db->deleteDate($params)) parent::redirectCustom('cms'.DS.'accomodation_type'.DS.'edit', array('id' => $params['id'], 'step' => 'second'));
		else parent::redirect('cms'.DS.'accomodation_type', 'error');
	}
	
	public function position($params){
		//Check session user
		parent::userInfoAndSession();
		
		if($this->db->setPosition($params)) parent::redirect('cms'.DS.'accomodation_type', '');
		else parent::redirect('cms'.DS.'accomodation_type', 'error');
	}
	
}