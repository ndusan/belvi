<?php
class Cms_conditionsController extends Controller{
	
	public function index($params){
		
		//Check session user
		parent::userInfoAndSession();
		$cond = $this->db->getConditions();
		parent::set('cond', $cond);
		parent::set('active', 'carriere');
	}
	
	public function submit($params){
		
		if($this->db->submit($params)) parent::redirect('cms'.DS.'conditions', 'success');
		else parent::redirect('cms'.DS.'conditions', 'error');
	}
}