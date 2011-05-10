<?php
/**
 * Model
 * @author ndusan
 *
 */
class Model{
	
	protected $_dbHandle;
	
	/**
	 * Contructor
	 * @return boolean
	 */
	function __construct(){
		$this->_dbHandle = @mysql_connect(DB_HOST, DB_USER, DB_PASS);
        if ($this->_dbHandle != 0) {
            if (mysql_select_db(DB_NAME, $this->_dbHandle)){
            	@mysql_query("SET NAMES 'utf8'", $this->_dbHandle);
				@mysql_query("SET CHARACTER_SET_CLIENT=utf8", $this->_dbHandle);
				@mysql_query("SET CHARACTER_SET_RESULTS=utf8", $this->_dbHandle);
				@mysql_query("SET CHARACTER_SET_CONNECTION=utf8", $this->_dbHandle);
				return true;   
            } 
            else return false;
        } else return false;
	}

	/**
	 * Get error string
	 * @return string
	 */
	function getError() {
        return mysql_error($this->_dbHandle);
    }
    
    /**
     * Password generator
     * @param int $len
     * @return string
     */
    function passwordGenerator($len = 6){
	    $r = '';
	    for($i=0; $i<$len; $i++)
	        $r .= chr(rand(0, 25) + ord('a'));
	    return $r;
    }
    
    /**
     * Get user info
     * @param array $params
     * @return array
     */
    function getUserInfo($params){
    	$query = sprintf("SELECT * FROM `users` WHERE `id`='%s'",
    					$params['id']
    					);
    	$res = mysql_query($query);
    	return mysql_fetch_assoc($res);
    }
    
	/**
	* turns mysql resource into array
	* @param resource $result
	* @return array
	*/
	function result_to_array($result){
		$result_array = array();
	    for ($i=0; $row = @mysql_fetch_array($result); $i++){
	    	$result_array[$i] = $row; 
	    }
	    return $result_array;
	}
	
	/**
	 * Return output
	 * @param String $string
	 * @return array
	 */
	function query($string){
		
		$res = mysql_query($string);
		if(mysql_num_rows($res) <= 0) return false;
		
		$output = array();
		while($row = mysql_fetch_assoc($res)) $output[] = $row;
		
		return $output;
	}
	
	function queryOne($string){
		
		$res = mysql_query($string);
		if(mysql_num_rows($res) <= 0) return false;
		
		return mysql_fetch_assoc($res);
		
	}
	
	function run($string){
		
		if(mysql_query($string)) return true;
		else return false;
	}
	
	function insert($string){
		
		$res = mysql_query($string);
		return mysql_insert_id($this->_dbHandle);
	}
	
	public function getNumOfCandidates(){
		
		$query = sprintf("SELECT count(*) AS `num` FROM `carriere` WHERE `new`='1' ORDER BY `modif` DESC");
		return $this->queryOne($query);
	}
	
	public function getLeftMenu(){
		$output = array();
		//Title
		$query = sprintf("SELECT * FROM `destinations` WHERE `visible`='1' ORDER BY `position` DESC");
		$rows = $this->query($query);
		if($rows)
			foreach($rows as $row){
				//Get elements
				$query_e = sprintf("SELECT * FROM `accomodation_types` WHERE `destination_id`='%s' AND `name`!='#' ORDER BY `position_left` DESC",
									mysql_real_escape_string($row['id'])
									);
				$row_e = $this->query($query_e);
				$row['sub_nav']  = $row_e;
				$output[] = $row;
			}
		return $output;
	}
	
	public function getCarouselImages(){
		
		$query = sprintf("SELECT `carousel`.*, `accomodation_types`.`link_name` AS `accomodation_type`,
							`accomodation_types`.`accomodation`
							FROM `carousel` 
							INNER JOIN `accomodation_types` ON 
								`accomodation_types`.`id`=`carousel`.`accomodation_type_id`
							ORDER BY `carousel`.`position` DESC");
		return $this->query($query);
	}
	
	protected function getLinkName($params, $tbl){
		
		
		$tmpName = strtolower($this->cleanString($params['name']));
		$myName = $tmp;
		$inUse = true;
		$count = 0;
		//Check if this name is already in use
		do{
			$q = sprintf("SELECT * FROM `%s` WHERE `link_name`='%s' AND `id`!='%s'",
						mysql_real_escape_string($tbl),
						mysql_real_escape_string($tmpName),
						mysql_real_escape_string($params['id'])
						);	
			$res = mysql_query($q);
			//Unique
			if(mysql_num_rows($res) <= 0) $inUse = false;
			else{
				//Add something to name
				$tmpName = $myName . "-" . ++$count;
			}
		}while($inUse);
				
			
		
		return $tmpName;
	}
	
	protected function cleanString($string){
		//Filter the name
		$remove = array("~", "`", "!", "@", "#", "$", "%", "^", "*", "(", ")", "=", ",", "<", ".", ">", "/", "?", ":", ";". "'", "\\", "|", "\"");
		$string = str_replace($remove, "", $string);
		//Replace spaces with "-"
		$replace = array(" ", "&", "_", "+");
		$string = str_replace($replace, "-", $string);
		//Remove letters
		$string = str_replace("š", "s", $string);
		$string = str_replace("Š", "s", $string);
		$string = str_replace("đ", "dj", $string);
		$string = str_replace("Đ", "dj", $string);
		$string = str_replace("č", "c", $string);
		$string = str_replace("Č", "c", $string);
		$string = str_replace("ć", "c", $string);
		$string = str_replace("Ć", "c", $string);
		$string = str_replace("ž", "z", $string);
		$string = str_replace("Ž", "z", $string);
		return $string;
	}
	
	public function getAccomodationTypesFront($type){
		
		$output = array();
		
		$query = sprintf("SELECT `destinations`.* FROM `destinations`
							INNER JOIN `accomodation_types` ON `accomodation_types`.`destination_id`=`destinations`.`id`
							WHERE `accomodation_types`.`accomodation`='%s'
							GROUP BY `destinations`.`name`
							ORDER BY `destinations`.`id` DESC",
						mysql_real_escape_string($type)
						);
						
		$rows = self::query($query);
		if(!$rows) return false;
		
		foreach($rows as $row){
			
			$q = sprintf("SELECT * FROM `accomodation_types`
							WHERE `destination_id`='%s' AND `accomodation`='%s'",
						mysql_real_escape_string($row['id']),
						mysql_real_escape_string($type)
						);
			$row['acc'] = self::query($q);
			
			$output[] = $row;
		}
		return $output;
	}
	
	public function getGroupsCarouselFront($name){
		
		$query = sprintf("SELECT `accomodation_type_images`.* FROM `accomodation_type_images`
							INNER JOIN `accomodation_types` ON `accomodation_types`.`id`=`accomodation_type_images`.`accomodation_type_id`
							WHERE `accomodation_types`.`link_name`='%s'",
						mysql_real_escape_string($name)
						);
		return self::query($query);
	}
	
	public function getGroupsCarouselDetails($name){
		$query = sprintf("SELECT `accomodation_images`.* FROM `accomodation_images`
							INNER JOIN `accomodations` ON `accomodations`.`id`=`accomodation_images`.`accomodation_id`
							WHERE `accomodations`.`link_name`='%s'",
						mysql_real_escape_string($name)
						);
		return self::query($query);
		
	}
	
	public function getAccType($params){
		$output = array();
		
		$query = sprintf("SELECT * FROM `accomodation_types` WHERE `link_name`='%s'",
						mysql_real_escape_string($params['group'])
						);
		$output = array_merge($output, array('acc_type' => self::queryOne($query)));
		
		/** HOT FIX - ADDIN "ORDER BY `id` ASC" **/
		$query = sprintf("SELECT * FROM `accomodation_type_dates` WHERE `accomodation_type_id`='%s' ORDER BY `id` ASC",
						mysql_real_escape_string($output['acc_type']['id'])
						);
		$output = array_merge($output, array('dates' => self::query($query)));

		$query = sprintf("SELECT `accomodation_type_prices`.`price`, `transport`.`name` AS `transport` 
									FROM `accomodation_type_prices` 
									INNER JOIN `transport` ON `transport`.`id`=`accomodation_type_prices`.`transport_id`
									WHERE `accomodation_type_prices`.`accomodation_type_id`='%s'",
							mysql_real_escape_string($output['acc_type']['id'])
						);
		$output = array_merge($output, array('prices' => self::query($query)));

		return $output;
	}
	
	public function getAcc($params){
		$output = array();
		
		$query = sprintf("SELECT * FROM `accomodation_types` WHERE `link_name`='%s'",
						mysql_real_escape_string($params['group'])
						);
		$output = array_merge($output, array('acc_type' => self::queryOne($query)));
		
		$query = sprintf("SELECT `accomodations`.*, `types`.`name` AS `type` FROM `accomodations` 
							INNER JOIN `types` ON `types`.`id`=`accomodations`.`type_id`
							WHERE `accomodations`.`accomodation_type_id`='%s'
							ORDER BY `accomodations`.`type_id` DESC",
						mysql_real_escape_string($output['acc_type']['id'])
						);
		$res = mysql_query($query);
		if(mysql_num_rows($res) > 0){
			while($row = mysql_fetch_assoc($res)){
				
				$query_s = sprintf("SELECT * FROM `accomodation_services` WHERE
									`accomodation_id`='%s'",
									mysql_real_escape_string($row['id'])
									); 
				$res_s = mysql_query($query_s);
				if(mysql_num_rows($res_s) > 0){
					while($row_s = mysql_fetch_assoc($res_s)){
						/** HOT FIX - ADDING "ORDER BY `accomodation_type_date_id` ASC" **/
						$query_p = sprintf("SELECT * FROM `accomodation_prices` WHERE
											`accomodation_id`='%s' AND 
											`accomodation_service_id`='%s' 
											ORDER BY `accomodation_type_date_id` ASC",
											mysql_real_escape_string($row['id']),
											mysql_real_escape_string($row_s['id'])
											);
						$res_p = mysql_query($query_p);
						if(mysql_num_rows($res_p) > 0){
							while($row_p = mysql_fetch_assoc($res_p)) $row_s['price'][] = $row_p;
						}
						$row['service'][] = $row_s;
					}
				}
				$output['acc'][] = $row;
			}
		}
		
		return $output; 
	}
	
	
	public function getOneAcc($params){
		$output = array();
		
		$query = sprintf("SELECT `accomodations`.*, `types`.`name` AS `type` FROM `accomodations` 
							INNER JOIN `types` ON `types`.`id`=`accomodations`.`type_id`
							WHERE `accomodations`.`link_name`='%s'
							ORDER BY `accomodations`.`type_id` DESC",
						mysql_real_escape_string($params['detail'])
						);
		$res = mysql_query($query);
		if(mysql_num_rows($res) > 0){
			while($row = mysql_fetch_assoc($res)){
				
				$query_s = sprintf("SELECT * FROM `accomodation_services` WHERE
									`accomodation_id`='%s'",
									mysql_real_escape_string($row['id'])
									); 
				$res_s = mysql_query($query_s);
				if(mysql_num_rows($res_s) > 0){
					while($row_s = mysql_fetch_assoc($res_s)){
						/** HOT FIX - ADDING "ORDER BY `accomodation_type_date_id` ASC" **/
						$query_p = sprintf("SELECT * FROM `accomodation_prices` WHERE
											`accomodation_id`='%s' AND 
											`accomodation_service_id`='%s' 
											ORDER BY `accomodation_type_date_id` ASC",
											mysql_real_escape_string($row['id']),
											mysql_real_escape_string($row_s['id'])
											);
						$res_p = mysql_query($query_p);
						if(mysql_num_rows($res_p) > 0){
							while($row_p = mysql_fetch_assoc($res_p)) $row_s['price'][] = $row_p;
						}
						$row['service'][] = $row_s;
					}
				}
				$output['acc'][] = $row;
			}
		}
		
		return $output; 
	}
	
	public function getAccomodationTypes(){
		$query = sprintf("SELECT * FROM `destinations`");
		return self::query($query);
	}
	
	public function getTransports(){
		$query = sprintf("SELECT * FROM `transport`");
		return self::query($query);
	}

	public function getDescriptionAndKeywords($pageType, $id)
	{
		$query = sprintf("SELECT `web_desc`, `web_keywords` FROM `%s` WHERE `link_name`='%s'",
						mysql_real_escape_string($pageType),
						mysql_real_escape_string($id)
						);

		$res = self::queryOne($query);
		
		return array('web_desc' => $res['web_desc'], 'web_keywords' => $res['web_keywords']);
	}
	
}
