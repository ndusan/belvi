<?php
class LoginController extends Controller{
	
	public function index($params){

		//Check if there is COOKIE set
		if(isset($_COOKIE['belvi']) && !empty($_COOKIE['belvi'])){
			
			$usr = $this->db->getUserFromCookie($_COOKIE['belvi']);
			if($usr){
				//Set session
				$_SESSION['belvi'] = $usr;
				//Redirect page
				parent::redirect('cms', '');
			}
		}
	}
	
	public function submit($params){
		
		//Check if remember me is set
		$usr = $this->db->getUser($params);
		
		if($usr){
			//Chech if Remember me is set
			if(isset($params['remember']) && !empty($params['remember'])){
				setcookie('belvi', $usr['token'], time() + 60*60*24*10, "/");
			}
			
			//Set session
			$_SESSION['belvi'] = $usr;
			
			//Set log for user
			$this->db->setLog($_SESSION['belvi'], $_SERVER);
			
			//Redirect page
			parent::redirect('cms', '');
		}else parent::redirect('login', 'error');
		
		return true;
	}
	
	public function logout($params){
		
		//Delete cookies
		if(isset($_COOKIE['belvi']) && !empty($_COOKIE['belvi'])) setcookie('belvi', "", time() - 1, "/");
		
		//Delete session
		unset($_SESSION['belvi']);
		parent::redirect("login", "");
	}
}