<?php
class Cms_online_bookingController extends Controller{
	
	public function index($params){
		
		$bookings = $this->db->getOnlineBooking();
		
		parent::set('bookings', $bookings);
		parent::set('active', 'online_booking');
	}
	
	public function delete($params){
		
		if($this->db->delete($params)) parent::redirect('cms'.DS.'online_booking', 'success');
		else parent::redirect('cms'.DS.'online_booking', 'error');
	}
	
}