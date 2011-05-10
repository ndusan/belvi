<?php
class HomeController extends Controller{
	
	public function index($params){
		
		parent::set('onHome', $this->db->getHome());
		
		parent::set('active', 'pocetna');
		
	}
	
	public function getTabPage($params){
		
		if(isset($params['tab'])){
			switch($params['tab']){
				
				case 'link-desc':
					$content = $this->db->getAdditionalInfo($params, 'accomodation_types', 'gen_desc'); 
					include_once VIEW_PATH.'home'.DS.'_infoView.php';
					break;
				case 'link-conditions':
					$content = $this->db->getAdditionalInfo($params, 'accomodation_types', 'conditions'); 
					include_once VIEW_PATH.'home'.DS.'_infoView.php';
					break;
				case 'link-desc-acc':
					$content = $this->db->getAdditionalInfo($params, 'accomodations', 'desc'); 
					include_once VIEW_PATH.'home'.DS.'_infoView.php';
					break;
				case 'link-conditions-acc':
					$content = $this->db->getAdditionalInfo($params, 'accomodations', 'conditions'); 
					include_once VIEW_PATH.'home'.DS.'_infoView.php';
					break;
				case 'link-map-acc':
					$content = $this->db->getAdditionalInfo($params, 'accomodations', 'map');
					include_once VIEW_PATH.'home'.DS.'_mapView.php';
				break;
				case 'link-weather-acc':
					$content = $this->db->getAdditionalInfo($params, 'accomodations', 'code');
					include_once VIEW_PATH.'home'.DS.'_weatherView.php';
				break;
				default: //error
			}
			
		}else{
			//error
		}
	}
	
	public function getHotels($params){
		
		if(!empty($params['id'])){
			echo json_encode($this->db->getHotels($params));
		}else echo false;
	}

public function robots(){
	$string = "";
	$string.= "User-agent: *\n";	
	$string.= "Allow: /";
echo $string;
}
	
}