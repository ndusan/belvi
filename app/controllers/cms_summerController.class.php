<?php
class Cms_summerController extends Controller{
	
	
	public function index(){
		
		//Check session user
		parent::userInfoAndSession();
		$e = $this->db->getEntry();
		parent::set('entry', $e);

		//Set page
		parent::set('active', 'summer');
	}
	
	public function add($params){
		//Check session user
		parent::userInfoAndSession();

		if(isset($params['step']) && !empty($params['step'])){
			switch(strtolower($params['step'])){
				case 'first':
					parent::set('accomodation_types', $this->db->getAccomodationTypes());
					parent::set('types', $this->db->getTypes());
				break;
				case 'second':
				break;
				case 'third':
					parent::set('services', $this->db->getSelectedServices($params));
					parent::set('dates', $this->db->getDates($params));
				break;
				default: 
			}
		}else{
			
			parent::set('accomodation_types', $this->db->getAccomodationTypes());
			parent::set('types', $this->db->getTypes());
		}
		//Set page
		parent::set('active', 'summer');
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
					$e = $this->db->getAccomodation($params);
					parent::set('acc', $e); 
					parent::set('accomodation_types', $this->db->getAccomodationTypes());
					parent::set('types', $this->db->getTypes());
				break;
				case 'second':
					parent::set('output', $this->db->getSelectedServices($params));	
				break;
				case 'third':
					parent::set('services', $this->db->getSelectedServices($params));
					parent::set('dates', $this->db->getDates($params));
					parent::set('price', $this->db->getSetDateServices($params));
				break;
				default: 
			}
		}else{
			
			$e = $this->db->getAccomodation($params);
			parent::set('acc', $e); 
			parent::set('accomodation_types', $this->db->getAccomodationTypes());
			parent::set('types', $this->db->getTypes());
		}
		
		//Set page
		parent::set('active', 'summer');
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
		
		//Delete cache on front-end
		Cache::delete(array('key' => 'accomodation'));
		
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
				default: parent::redirect('cms'.DS.'summer', 'error');
			}
		else $this->submitFirst($params);
	}
	
	private function submitFirst($params){
		
		if($id = $this->db->submit($params)){
			
			//Upload files if
			if(isset($params['count']) && $params['count'] > 0){
				for($i=1; $i<=$params['count']; $i++){
					
					if(isset($params['file-' . $i]) && $params['file-' . $i]['error'] == 0){
						
						$tmpId = $this->db->manageFile($params['file-' . $i], $id);
						
						parent::uploadAndResizeImage(300, 300, $params['file-' . $i], $id.'-'.$tmpId.'-'.$params['file-' . $i]['name'], 'accomodation', true);
					}
				}
			}
			
			parent::redirectCustom('cms'.DS.'summer'.DS.$params['action'], array('id' => $id, 'step' => 'second'));
		}else parent::redirect('cms'.DS.'summer'.DS.$params['action'], 'error');
	}
	
	private function submitSecond($params){

		if($id = $this->db->submit($params))
			parent::redirectCustom('cms'.DS.'summer'.DS.$params['action'], array('id' => $id, 'step' => 'third'));
		else 
			parent::redirect('cms'.DS.'summer'.DS.$params['action'], 'error');
	}

	private function submitThird($params){

		if($this->db->submit($params))
			parent::redirect('cms'.DS.'summer', 'success');
		else 
			parent::redirect('cms'.DS.'summer'.DS.$params['action'], 'error');
	}
	
	public function deleteImage($params){
		//Check session user
		parent::userInfoAndSession();
		
		//Delete cache on front-end
		Cache::delete(array('key' => 'accomodation'));
		
		if(isset($params['id']) && !empty($params['id'])){
			if($oldFileName = $this->db->getOldFileName($params))
				parent::unlinkImage($oldFileName['accomodation_id'].'-'.$params['img_id']."-".$oldFileName['image'], 'accomodation', true);
		}
		
		if($this->db->deleteImage($params)) parent::redirect('cms'.DS.'summer'.DS.$params['id'].DS.'edit', 'success');
		else parent::redirect('cms'.DS.'summer', 'error');
	}
	
	public function deleteService($params){
		//Check session user
		parent::userInfoAndSession();
		
		//Delete cache on front-end
		Cache::delete(array('key' => 'accomodation'));
		
		if($this->db->deleteService($params)) parent::redirectCustom('cms'.DS.'summer'.DS.'edit', array('id' => $params['id'], 'step' => 'second'));
		else parent::redirect('cms'.DS.'summer', 'error');
	}
	
	public function delete($params){
		//Check session user
		parent::userInfoAndSession();
		
		//Delete cache on front-end
		Cache::delete(array('key' => 'accomodation'));
		
		if($images = $this->db->getImages($params)){
			foreach ($images as $i)
				parent::unlinkImage($i['accomodation_id']."-".$i['id']."-".$i['image'], 'accomodation', true);
		}
		
		if($this->db->delete($params)) parent::redirect('cms'.DS.'summer', 'success');
		else parent::redirect('cms'.DS.'summer', 'error');
	}
}