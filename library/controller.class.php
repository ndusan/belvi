<?php
/**
 * Default controller
 * @author ndusan
 *
 */
class Controller{

	protected $_template;
	protected $db;
	
	public $renderHTML = 0;
	
	/**
	 * Constructor
	 * @param String $controller
	 * @param String $action
	 * @param String $layout
	 * @return void
	 */
	function __construct($controller, $action, $layout){
		
		//Model file
		$modelFile = strtolower($controller)."Model.class.php";
		$modelName = ucfirst($controller)."Model";
		
		//Create model object
		if(file_exists('library'.DS.'model.class.php')) require_once 'library'.DS.'model.class.php';
		
		if(file_exists(MODEL_PATH.$modelFile)) require_once MODEL_PATH.$modelFile;
		$this->db = new $modelName;

		//Create template object
		if(file_exists('library'.DS.'template.class.php')) require_once 'library'.DS.'template.class.php';
		$this->_template = new Template($controller, $action, $layout);

		//Set num of new candidats that applied for job
		if(isset($_SESSION['belvi'])){
			$this->set('numOfCandidats', $this->db->getNumOfCandidates());

			//Clean cache
			Cache::deleteAll();
		} 
		
		if(isset($layout) && $layout == 'user'){
			//Get left menu from cache
			if(!Cache::get(array('key' => 'destinations'))){
				$des = $this->db->getLeftMenu();
				Cache::set(array('key' => 'destinations', 'data' => $des));
			}else $des = Cache::get(array('key' => 'destinations'));
			$this->set('leftNav', $des);
			
			//Carousel images
			if(!Cache::get(array('key' => 'carousel'))){
				$c = $this->db->getCarouselImages();
				Cache::set(array('key' => 'carousel', 'data' => $c));
			}else $c = Cache::get(array('key' => 'carousel'));
			$this->set('mainCarousel', $c);
			
			self::set('s_dest', $this->db->getAccomodationTypes());
			self::set('s_tr', $this->db->getTransports());
		}
	}
	
	/**
	 * Set variables
	 * @param String $name
	 * @param Array $value
	 * @return void
	 */
	function set($name, $value) {
		$this->_template->set($name, $value);
	}
	
	/**
	 * Default array of css files
	 * @param $array
	 * @return void
	 */
	function defaultCss($array){
		$this->_template->defaultCss($array);
	}
	
	/**
	 * Default array of js files
	 * @param $array
	 * @return void
	 */
	function defaultJs($array){
		$this->_template->defaultJs($array);
	}
	
	/**
	 * Redirect
	 * @param String $url
	 * @return void
	 */
	function redirect($url, $msg){

		$url = "Location: ".BASE_PATH.(empty($url) ? '' : $url.DS).(isset($msg) && !empty($msg) ? '?q='.$msg : "");
		header($url);
		exit;
	}
	
	function redirectCustom($url, $array){
		
		$url = "Location: ".BASE_PATH.$url.DS;
		if(isset($array) && !empty($array)){
			$count = 0;
			$tmpUrl = "";
			$first = true;
			foreach($array as $key => $val){
				$tmpUrl .= ($first?"?":"") . $key . "=" . $val . (++$count<count($array)?"&":"");
				$first = false;
			}
			$url .= $tmpUrl;
		}
		
		header($url);
		exit;
	}
	
	/**
	 * Desctructor
	 * @return void
	 */
	function __destruct(){
		$this->_template->render($this->renderHTML);
	}
	
	/**
	 * Set to render HTML in Ajax call
	 * @return void
	 */
	function renderHTML(){
		$this->renderHTML = 1;
	}
	
	function sendEmail($data){
		
		$from = "MIME-Version: 1.0\r\n";
        $from .= "Content-type: text/html; charset=utf-8\r\n";
        $from .= "From: Belvi<noreplay@belvi.rs>\r\n";
        
        $subject = $data['subject'];		
		$par = "<br/>";
		foreach($data['data'] as $key => $val)
			$par.= "<b>".$key."</b>: ".$val."<br/>";
        
        $head = "Sa sajta http://belvi.rs poslat je sledeci zahtev:";
        
        $sign = "S postovanjem,<br/><b>belvi.rs</b>";
        $mis = "<br/>Ukoliko ste greskom primili mejl, molimo vas da ga obrisete.";
				        
		//Skelet
        $msg_body="<html>
					<head>
					<title>Belvi</title>
					</head>
					<body>
					<table cellspacing='3' cellpadding='1' border='0' align='center' width='750' style='border: 1px solid #E5EBF2;'>
                    <tbody>
                       <tr>
                        <td style='background: #E5EBF2 none repeat scroll 0% 0%;'>
                        <a target='_blank' href='http://belvi.rs' style=' background: #E5EBF2 none repeat scroll 0% 0%; color: rgb(0, 173, 239); font-family: Tahoma,Arial; font-size: 11px;'>http://belvi.rs</a>
                        </td>
                       </tr>
                       <tr>
                        <td>
                       <table cellspacing='1' cellpadding='0' border='0' width='100%'>
                        <tbody>
                        <tr>
                        <td width='70%' valign='top' style='padding: 5px; background: rgb(244, 244, 244) none repeat scroll 0% 0%;'>
                        <div style='padding: 5px; background: rgb(0, 173, 239) none repeat scroll 0% 0%; color: rgb(255, 255, 255); font-weight: bold; font-family: Tahoma,Arial; font-size: 11px;'>
                        ".$subject."
                        </div><br/>
                        <div style='border: 1px solid rgb(204, 204, 204); padding: 2px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; font-size: 11px; margin-bottom: 10px; margin-top: 23px; font-family: Tahoma,Arial;'> 
                        <div style='padding: 2px; background: rgb(204, 204, 204) none repeat scroll 0% 0%; color: rgb(102, 102, 102); font-weight: normal; font-family: Tahoma,Arial; font-size: 11px;'>
                        ".$head."
                        </div>".$par."
                        </div>
                        </td>
                       </tr>
                     </tbody>
                     </table>
                    </td>
                    </tr>
                    <tr>
                <td valign='top' style='padding: 10px; background: #E5EBF2 none repeat scroll 0% 0%; color: rgb(0, 173, 239); font-family: Tahoma,Arial; font-size: 11px;'>
               ".$sign."
                    <br/>
                <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                      <tbody><tr>
                        <td style='background: #E5EBF2 none repeat scroll 0% 0%; color: rgb(0, 173, 239); font-weight: normal; font-family: Tahoma,Arial; font-size: 11px;'>
                        ".$mis."
                        </td>
                      </tr>
                </tbody></table></td>
              </tr>
            </tbody></table></body></html>";
		
        //Send email
        mail($data['email'], $subject, $msg_body, $from);
	}
	
	/**
	 * Check session
	 * @return void
	 */
	function userInfoAndSession(){
		if(!isset($_SESSION['belvi'])) $this->redirect('login', '');
		//Check for user info
		return $this->db->getUserInfo($_SESSION['belvi']);
	}
	
	/**
	 * Upload and resize image
	 * @param int $width
	 * @param int $height
	 * @param $_FILES $file
	 * @param String $imageName
	 * @param String $imagePath
	 * @return boolean
	 */
	public function uploadAndResizeImage($width, $height, $file, $imageName, $folder, $hasCarousel=false){
		
		//Check extension
		$allowedMimes = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
		
		if($file['error'] == 0){
			
			$imageInfo = getimagesize($file['tmp_name']);
			
			if(!isset($imageInfo['mime']) || !in_array($imageInfo['mime'], $allowedMimes)) return false;
			
			//Get width and heigh
			list($w, $h) = getimagesize($file['tmp_name']);
			
			$xscale = $w / $width;
	    	$yscale = $h / $height;
			
			 if ($yscale > $xscale){
		        $new_width = round($w * (1 / $yscale));
		        $new_height = round($h * (1 / $yscale));
		    }
		    else {
		        $new_width = round($w * (1 / $xscale));
		        $new_height = round($h * (1 / $xscale));
		    }
	    	
			$tmp = imagecreatetruecolor($new_width, $new_height);
			
			$filename_resized = UPLOAD_PATH . $folder . DS . 'resized' . DS . $imageName;
			$filename_original = UPLOAD_PATH . $folder . DS . 'original' . DS . $imageName;
			
			if($hasCarousel){
				$filename_carousel = UPLOAD_PATH . $folder . DS . 'carousel' . DS . $imageName;
				//Dim. for carousel
				$xscale = $w / CAROUSEL_WIDTH;
		    	$yscale = $h / CAROUSEL_HEIGHT;
				
				 if ($yscale > $xscale){
			        $new_carousel_width = round($w * (1 / $yscale));
			        $new_carousel_height = round($h * (1 / $yscale));
			    }
			    else {
			        $new_carousel_width = round($w * (1 / $xscale));
			        $new_carousel_height = round($h * (1 / $xscale));
			    }
			    $tmp_carousel = imagecreatetruecolor($new_carousel_width, $new_carousel_height);
			}
			
			switch($imageInfo['mime']){
				
				case 'image/jpg': case 'image/jpeg': //JPG or JPEG
					//Upload original
					copy($file['tmp_name'], $filename_original);
					
					$src = imagecreatefromjpeg($file['tmp_name']);
					
					imagecopyresampled($tmp, $src, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
					imagejpeg($tmp, $filename_resized);
					
					if($hasCarousel){
						imagecopyresampled($tmp_carousel, $src, 0, 0, 0, 0, $new_carousel_width, $new_carousel_height, $w, $h);
						imagejpeg($tmp_carousel, $filename_carousel);
					}
				break;
				case 'image/png': //PNG
					//Upload original
					copy($file['tmp_name'], $filename_original);
					
					$src = imagecreatefrompng($file['tmp_name']);
					
					imagecopyresampled($tmp, $src, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
					imagepng($tmp, $filename_resized);
					
					if($hasCarousel){
						imagecopyresampled($tmp_carousel, $src, 0, 0, 0, 0, $new_carousel_width, $new_carousel_height, $w, $h);
						imagepng($tmp_carousel, $filename_carousel);
					}
				break;
				case 'image/gif': //GIF
					//Upload original
					copy($file['tmp_name'], $filename_original);
					
					$src = imagecreatefromgif($file['tmp_name']);
					
					imagecopyresampled($tmp, $src, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
					imagegif($tmp, $filename_resized);
					
					if($hasCarousel){
						imagecopyresampled($tmp_carousel, $src, 0, 0, 0, 0, $new_carousel_width, $new_carousel_height, $w, $h);
						imagegif($tmp_carousel, $filename_carousel);
					}
				break;
				
				default: //Error 
				break;
			}
			
			imagedestroy($src);
			imagedestroy($tmp);
			
		}else return false;
		
		return true;
	}
	
	public function uploadFile($file, $imageName, $folder){
		//Upload original
		$filename_original = UPLOAD_PATH . $folder . DS . 'original' . DS . $imageName;
		if(copy($file['tmp_name'], $filename_original)) return true;
		else return false;
	}
	
	
	/**
	 * Unlink (delete) image from system
	 * @param String $imageName
	 * @param String $imagePath
	 * @return boolean
	 */
	public function unlinkImage($imageName, $folder, $hasCarousel){
		
		$oldImageOriginal = UPLOAD_PATH . $folder . DS . 'original' . DS . $imageName;
		$oldImageResized = UPLOAD_PATH . $folder . DS . 'resized' . DS . $imageName;
		
		if(isset($oldImageOriginal) && !empty($oldImageOriginal) && file_exists($oldImageOriginal)){ 
			unlink($oldImageOriginal);
			unlink($oldImageResized);
			if($hasCarousel)
				unlink(UPLOAD_PATH . $folder . DS . 'carousel' . DS . $imageName);

			return true;
		}
			
		return false;
	}
	
/**
	 * Unlink (delete) image from system
	 * @param String $imageName
	 * @param String $imagePath
	 * @return boolean
	 */
	public function unlinkFile($imageName, $folder){
		
		$oldImageOriginal = UPLOAD_PATH . $folder . DS . 'original' . DS . $imageName;
		if(isset($oldImageOriginal) && !empty($oldImageOriginal) && file_exists($oldImageOriginal)){ 
			unlink($oldImageOriginal);
			return true;
		}
			
		return false;
	}
	
	public function getImage($imageName, $folder){
		$output = array();
		
		if(file_exists(UPLOAD_PATH . $folder . DS . 'original' . DS . $imageName))
			return array('original' => UPLOAD_PATH . $folder . DS . 'original' . DS . $imageName,
						 'resized'	=> UPLOAD_PATH . $folder . DS . 'resized' . DS . $imageName,
						 'carousel'	=> file_exists(UPLOAD_PATH . $folder . DS . 'carousel' . DS . $imageName) ? UPLOAD_PATH . $folder . DS . 'resized' . DS . $imageName : ""
						);
		else return false;
	}
	
}