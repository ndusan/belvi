<?php
class Cms_carriereController extends Controller{
	
	public function index($params){
		//Check session user
		parent::userInfoAndSession();
		$carrieres = $this->db->getCandidates();
		parent::set('carrieres', $carrieres);
		parent::set('active', 'carriere');
	}
	
	public function delete($params){
		//Check session user
		parent::userInfoAndSession();
		if($this->db->delete($params)) parent::redirect('cms'.DS.'carriere', 'success');
		else parent::redirect('cms'.DS.'carriere', 'error');
	}
	
	public function position($params){
		//Check session user
		parent::userInfoAndSession();
		parent::set('pos', $this->db->getPositions());
		parent::set('active', 'carriere');
	}
	
	public function add($params){
		//Check session user
		parent::userInfoAndSession();
		
		parent::set('active', 'carriere');
	}
	
	public function edit($params){
		//Check session user
		parent::userInfoAndSession();
		parent::set('p', $this->db->getPosition($params));
		parent::set('active', 'carriere');
	}
	
	public function submit($params){
		//Check session user
		parent::userInfoAndSession();
		if($this->db->submit($params)) parent::redirect('cms'.DS.'carriere'.DS.'position', 'success');
		else parent::redirect('cms'.DS.'carriere'.DS.'position', 'error');
	}
	
	public function deletePosition($params){
		//Check session user
		parent::userInfoAndSession();
		
		if($this->db->deletePosition($params)) parent::redirect('cms'.DS.'carriere'.DS.'position', 'success');
		else parent::redirect('cms'.DS.'carriere'.DS.'position', 'error');
	}
}