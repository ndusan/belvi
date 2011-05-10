<?php
class ConditionsController extends Controller{
	
	public function index($params){
		
		parent::set('cond', $this->db->getConditions());
	}
}