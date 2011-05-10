<?php

class SearchController extends Controller{

    public function index($params){

        parent::set('res', $this->db->getResults($params));
    }
    
    public function getDestinations($params){
    	
    	echo json_encode($this->db->getDestinations($params));
    }
}