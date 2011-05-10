<?php
class Cms_usersController extends Controller{

	public function index($params){
		//Check session user
		parent::userInfoAndSession();
		
		$users = $this->db->getAllUsers();
		parent::set('users', $users);
		
		//Set params
		parent::set('params', $params);
		//Set page
		parent::set('active', 'users');
	}
	
	public function add($params){
		//Check session user
		parent::userInfoAndSession();
		
		//Set params
		parent::set('params', $params);
		//Set page
		parent::set('active', 'users');
	}
	
	public function edit($params){
		//Check session user
		parent::userInfoAndSession();
		
		$usr = $this->db->getUserById($params);
		if($usr) parent::set("usr", $usr[0]);
		else parent::set("cms".DS."users", "error");
		
		//Set params
		parent::set('params', $params);
		//Set page
		parent::set('active', 'users');
	}
	
	public function submit($params){
		//Check session user
		parent::userInfoAndSession();
		
		if(isset($params['id']) && !empty($params['id'])) $action = DS.$params['id'].DS."edit";
		else $action = DS."add";
		
		$response = $this->db->submit($params);
		if($response) parent::redirect("cms".DS."users", "success");
		else parent::redirect("cms".DS."users".$action, "error");
	}
	
	public function delete($params){
		//Check session user
		parent::userInfoAndSession();
		
		$response = $this->db->deleteUser($params);
		if($response) parent::redirect("cms".DS."users", "success");
		else parent::redirect("cms".DS."users", "error");
	}
}