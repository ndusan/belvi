<?php
class Rent_a_carController extends Controller{
	
	public function index($params){
		
		parent::set('cars', $this->db->getCars());
		parent::set('active', 'rent-a-car');
	}
}