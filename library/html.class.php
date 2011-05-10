<?php
/**
 * HTML 
 * @author ndusan
 *
 */
class HTML{
	
	/**
	 * Include JS
	 * @param $fileName
	 * @return string
	 */
	function js($fileName) {
		$data = "<script src='".JS_PATH.$fileName.".js' type='text/javascript'></script>\n";
		return $data;
	}
	
	/**
	 * Custom made css
	 * @param array $array
	 * @return string
	 */
	function customCss($array){
		$string = "";
		if(isset($array) && !empty($array))
    	for($i=0; $i<count($array); $i++)
			$string .= $this->css($array[$i]);
		return $string;
	}
	
	/**
	 * Custom made js
	 * @param array $array
	 * @return string
	 */
	function customJs($array){
		$string = "";
		if(isset($array) && !empty($array))
    	for($i=0; $i<count($array); $i++)
			$string .= $this->js($array[$i]);
		return $string;
	}
	
	/**
	 * Include CSS
	 * @param $fileName
	 * @return string
	 */
	function css($fileName) {
		$data = "<link href='".CSS_PATH.$fileName.".css' rel='stylesheet' type='text/css'/>\n";
		return $data;
	}
	
	/**
	 * Display message
	 * @param String $text
	 * @return String
	 */
	function msg($text){
		
		if(!isset($text) || empty($text)) return false;
		$txt = "";
		switch($text){
			//Error
			case 'error':
						$txt = "<div class='j_msg_error'>".ERROR_MSG."</div>";
						break;
			//Success
			case 'success':
						$txt = "<div class='j_msg_success'>".SUCCESS_MSG."</div>";
						break;
			case 'email':
						$txt = "<div class='j_msg_error'>".EMAIL_ERROR_MSG."</div>";
						break;
			default:	
						$txt = "<div class='j_msg_error'>".$text."</div>";
						break;
		}
		return $txt;
	}
	
	function carousel($params, $folder=null, $action=null, $page='accomodation_type_id'){
		$html = "";
		switch($action){
			
			case 'events':
				if(isset($params) && !empty($params)){
					$html = "<ul id='mycarousel' class='jcarousel-skin-tango'>";
							foreach($params as $i){
								$html.= "<li>
											<a href='" . BASE_PATH . 'dogadjaji' . DS . $i['id'] . DS . "'>
						    					<img src='" . FILE_PATH . $folder . DS . 'carousel' . DS . $i['id'].'-'.$i['image'] . "'  alt='" . $i['image'] . "' />
						    				</a>
										</li>";
							}
					$html.= "</ul>";		
				}
				break;
			case 'summer': case 'winter': case 'city_break': case 'other': case 'wellness_and_spa': case 'destination':
				if(isset($params) && !empty($params)){
					$html = "<ul id='mycarousel' class='jcarousel-skin-tango'>";
							foreach($params as $i){
								$html.= "<li>
						    				<img src='" . FILE_PATH . $folder . DS . 'carousel' . DS . $i[$page].'-'.$i['id'].'-'.$i['image'] . "'  alt='" . $i['image'] . "' />
										</li>";
							}
					$html.= "</ul>";		
				}
				break;
			default: //error
		}
		return $html;
	}
	
	static function getWeather($city_id = 0) {

		$response = '';
		if(isset($city_id) && !empty($city_id)){
			$requestAddress = $city_id;
			
			$xml_str = file_get_contents("http://xoap.weather.com/weather/local/".$requestAddress."?cc=*&dayf=5&link=xoap&prod=xoap&par=1225844858&key=e874d961c427e609", 0);
			// Parses XML
			$xml = new SimplexmlElement($xml_str);
			//print_r($xml);
			// Name
			$response.= "<h1 class='borBot'>".$xml->loc->dnam."</h1>";
			$response.= "<table class='borBot' style='margin:10px 0 10px; text-align:center' cellspacing='0' cellpading='0' width='100%'>
							<tbody>
								<tr>";
			//Set date
			$date = substr($xml->dayf->lsup, 0, 8);
			$date = explode("/", $date);
			$day = 0;
			foreach($xml->dayf->day as $item) {
				if($item->hi != 'N/A'){
					$date_out = @date("d-m-Y", mktime(0, 0, 0, $date[0], $date[1]+$day, "20".$date[2]));
					$day++;
					$response.= "<td>";
	                $response .= "<label>".$date_out."</label>";
					$max = round((5/9)*($item->low-32));
					$response .= "<div>min temp: ".$max."&deg</div>";
					$min = round((5/9)*($item->hi-32));
					$response .= "<div>max temp: ".$min."&deg</div>";
	                $response .= "<br/>";
	                $first = true;
					foreach($item->part as $new) {
						$response.= '<div>';
							//Image
	                        $response .= "<label>".($first ? "Day" : "Evening")."</label>";
							$response.= '<img src="http://s.imwx.com/v.20100415.153311/img/wxicon/45/'.$new->icon.'.png"/><br/>';
							$response .= "<div>".$new->t."</div>";
						$response.= '</div>';
	                    $response .= "<br/>";
	                    $first = false;
					}
					$response .= "</td>";
				}
			}
			$response.= "</tr>
							</tbody>
								</table>";
		}
	  	return $response;	
		
  	}
  	
  	public function toSerbian($string){
  		
  		$str = array("Jan" => "Jan", "Feb" => "Feb", "Mar" => "Mar", "Apr" => "Apr", "May" => "Maj", "Jun" => "Jun", "Jul" => "Jul", "Aug" => "Avg", "Sep" => "Sep", "Oct" => "Okt", "Nov" => "Nov", "Dec" => "Dec");
  	
  		foreach($str as $key => $val)
  			if($key == $string) return $val;
  			
  		return $string;
  	}
}