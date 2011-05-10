<?php
class CarriereController extends Controller{
	
	public function index($params){
		
		parent::set('active', 'zaposlenje');
		
		parent::set('pos', $this->db->getPositions());
		
		parent::defaultJs(array('carriere'));
	}
	
	public function submit($params){
		
		if($this->db->submit($params)){
			//send by email
			
			$data = array(	'Ime i prezime' 				=> 	$params['candidat'],
							'Konkurišem za radno mesto' 	=> 	$params['position'],
							'Stručna sprema'				=>	$params['level'],
							'Godište'						=>	$params['born'],
							'Profesija'						=>	$params['profession'],
							'Godina sticanja stručne spreme'=> 	$params['year'],
							'Radno iskustvo'				=>	$params['expirience'],
							'Razlozi'						=>	$params['reason'],
							'Posebni kvaliteti'				=>	$params['features'],
							'El.adresa'						=>	$params['email'],
							'Kontakt telefon'				=>	$params['telephone']
			);
			
			parent::sendEmail(array('subject' => "Prijava za posao", 'data' => $data, 'email' => 'office@belvi.rs'));
			
			parent::redirect('zaposlenje', 'success');
		} 
		else parent::redirect('zaposlenje', 'error');
	}
}