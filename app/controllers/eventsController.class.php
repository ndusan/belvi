<?php
class EventsController extends Controller{
	
	public function index($params){
		
		
		if(isset($params['id']) && !empty($params['id'])){
			if(!$tmp = $this->db->getSelectedEvent($params)) $e = $this->db->getMainEvent();
			else $e = $tmp;
		}else $e = $this->db->getMainEvent();
		parent::set('event', $e);

		//Carousel data
		parent::set('carouselImage', $this->db->getCarouselImagesEvent($params));
		parent::set('carouselFolder', 'events');
		parent::set('carouselAction', 'events');
		
		//Set page
		parent::set('active', 'dogadjaji');
	}
}