<?php
class ContactModel extends Model{
	
	public function getLocations(){
 		
 		$query = sprintf("SELECT * FROM `locations` ORDER BY `position` DESC");
 		return parent::query($query);
 	}
}