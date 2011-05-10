<?php
$routes = array(
				//Home page
				array(	'url' 			=> '/^\/?$/', 
						'controller' 	=> 'home', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'user'
				),
				//Ajax
				array(	'url' 			=> '/^rezervacije\/ajax-get-hotels\/?$/', 
						'controller' 	=> 'online_booking', 
					  	'action' 		=> 'getHotels', 
					  	'layout' 		=> 'empty'
				),
				//Contact page
				array(	'url' 			=> '/^kontakt\/?$/', 
						'controller' 	=> 'contact', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'user'
				),
				//Carriere
//				array(	'url' 			=> '/^zaposlenje\/?$/', 
//						'controller' 	=> 'carriere', 
//					  	'action' 		=> 'index', 
//					  	'layout' 		=> 'user'
//				),
//				array(	'url' 			=> '/^zaposlenje\/submit\/?$/', 
//						'controller' 	=> 'carriere', 
//					  	'action' 		=> 'submit', 
//					  	'layout' 		=> 'empty'
//				),
				//Daleke destinacije
				array(	'url' 			=> '/^daleke-destinacije\/?$/', 
						'controller' 	=> 'destination', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'user'
				),
				array(	'url' 			=> '/^daleke-destinacije\/(?P<group>[a-zA-Z0-9\_\-%]+)\/?$/', 
						'controller' 	=> 'destination', 
					  	'action' 		=> 'group', 
					  	'layout' 		=> 'user'
				),
				array(	'url' 			=> '/^daleke-destinacije\/(?P<group>[a-zA-Z0-9\_\-%]+)\/(?P<detail>[a-zA-Z0-9\_\-%]+)\/?$/', 
						'controller' 	=> 'destination', 
					  	'action' 		=> 'details', 
					  	'layout' 		=> 'user'
				),
				//Wellness and spa
				array(	'url' 			=> '/^wellness-and-spa\/?$/', 
						'controller' 	=> 'wellness_and_spa', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'user'
				),
				array(	'url' 			=> '/^wellness-and-spa\/(?P<group>[a-zA-Z0-9\_\-%]+)\/?$/', 
						'controller' 	=> 'wellness_and_spa', 
					  	'action' 		=> 'group', 
					  	'layout' 		=> 'user'
				),
				array(	'url' 			=> '/^wellness-and-spa\/(?P<group>[a-zA-Z0-9\_\-%]+)\/(?P<detail>[a-zA-Z0-9\_\-%]+)\/?$/', 
						'controller' 	=> 'wellness_and_spa', 
					  	'action' 		=> 'details', 
					  	'layout' 		=> 'user'
				),
				//Events
				array(	'url' 			=> '/^dogadjaji\/?(?P<id>\d*)\/?$/', 
						'controller' 	=> 'events', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'user'
				),
				//Online booking
				array(	'url' 			=> '/^rezervacije\/?$/', 
						'controller' 	=> 'online_booking', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'user'
				),
				array(	'url' 			=> '/^rezervacije\/submit\/?$/', 
						'controller' 	=> 'online_booking', 
					  	'action' 		=> 'submit', 
					  	'layout' 		=> 'empty'
				),
				//Rent a car
				array(	'url' 			=> '/^rent-a-car\/?$/', 
						'controller' 	=> 'rent_a_car', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'user'
				),
				//Letovanje
				array(	'url' 			=> '/^letovanja\/?$/', 
						'controller' 	=> 'summer', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'user'
				),
				array(	'url' 			=> '/^letovanja\/(?P<group>[a-zA-Z0-9\_\-%]+)\/?$/', 
						'controller' 	=> 'summer', 
					  	'action' 		=> 'group', 
					  	'layout' 		=> 'user'
				),
				array(	'url' 			=> '/^letovanja\/(?P<group>[a-zA-Z0-9\_\-%]+)\/(?P<detail>[a-zA-Z0-9\_\-%]+)\/?$/', 
						'controller' 	=> 'summer', 
					  	'action' 		=> 'details', 
					  	'layout' 		=> 'user'
				),
				//Uslovi 
				array(	'url' 			=> '/^uslovi\/?$/', 
						'controller' 	=> 'conditions', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'user'
				),
				//City break
				array(	'url' 			=> '/^evropski-gradovi\/?$/', 
						'controller' 	=> 'city_break', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'user'
				),
				array(	'url' 			=> '/^evropski-gradovi\/(?P<group>[a-zA-Z0-9\_\-%]+)\/?$/', 
						'controller' 	=> 'city_break', 
					  	'action' 		=> 'group', 
					  	'layout' 		=> 'user'
				),
				array(	'url' 			=> '/^evropski-gradovi\/(?P<group>[a-zA-Z0-9\_\-%]+)\/(?P<detail>[a-zA-Z0-9\_\-%]+)\/?$/', 
						'controller' 	=> 'city_break', 
					  	'action' 		=> 'details', 
					  	'layout' 		=> 'user'
				),
				//Other
				array(	'url' 			=> '/^specijalno\/?$/', 
						'controller' 	=> 'other', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'user'
				),
				array(	'url' 			=> '/^specijalno\/(?P<group>[a-zA-Z0-9\_\-%]+)\/?$/', 
						'controller' 	=> 'other', 
					  	'action' 		=> 'group', 
					  	'layout' 		=> 'user'
				),
				array(	'url' 			=> '/^specijalno\/(?P<group>[a-zA-Z0-9\_\-%]+)\/(?P<detail>[a-zA-Z0-9\_\-%]+)\/?$/', 
						'controller' 	=> 'other', 
					  	'action' 		=> 'details', 
					  	'layout' 		=> 'user'
				),
				//Zimovanje
				array(	'url' 			=> '/^zimovanja\/?$/', 
						'controller' 	=> 'winter', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'user'
				),
				array(	'url' 			=> '/^zimovanja\/(?P<group>[a-zA-Z0-9\_\-%]+)\/?$/', 
						'controller' 	=> 'winter', 
					  	'action' 		=> 'group', 
					  	'layout' 		=> 'user'
				),
				array(	'url'           => '/^zimovanja\/(?P<group>[a-zA-Z0-9\_\-%]+)\/(?P<detail>[a-zA-Z0-9\_\-%]+)\/?$/',
						'controller'    => 'winter',
					  	'action' 		=> 'details', 
					  	'layout' 		=> 'user'
				),
				array(	'url'           => '/^ajax_get_tab_page\/?$/',
						'controller'    => 'home',
					  	'action' 		=> 'getTabPage', 
					  	'layout' 		=> 'empty'
				),
                                //Pretraga
				array(	'url'           => '/^pretraga\/?$/',
						'controller'    => 'search',
					  	'action' 		=> 'index',
					  	'layout' 		=> 'user'
				),
				array(	'url'           => '/^pretraga\/get-destinations\/?$/',
						'controller'    => 'search',
					  	'action' 		=> 'getDestinations',
					  	'layout' 		=> 'empty'
				),
				//******Login page*********
				array(	'url' 			=> '/^login\/?$/', 
						'controller' 	=> 'login', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'login'
				),
				array(	'url' 			=> '/^login\/submit\/?$/', 
						'controller' 	=> 'login', 
					  	'action' 		=> 'submit', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^logout\/?$/', 
						'controller' 	=> 'login', 
					  	'action' 		=> 'logout', 
					  	'layout' 		=> 'empty'
				),
				//********Admin panel*******
				array(	'url' 			=> '/^cms\/?$/', 
						'controller' 	=> 'cms_home', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/set-visible\/?$/', 
						'controller' 	=> 'cms_home', 
					  	'action' 		=> 'setVisible', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/(?P<id>\d*)\/position\/?$/', 
						'controller' 	=> 'cms_home', 
					  	'action' 		=> 'position', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/carousel\/?$/', 
						'controller' 	=> 'cms_home', 
					  	'action' 		=> 'carousel', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/carousel\/add\/?$/', 
						'controller' 	=> 'cms_home', 
					  	'action' 		=> 'add', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/carousel\/submit\/?$/', 
						'controller' 	=> 'cms_home', 
					  	'action' 		=> 'submit', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/carousel\/(?P<id>\d*)\/position\/?$/', 
						'controller' 	=> 'cms_home', 
					  	'action' 		=> 'carouselPosition', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/carousel\/(?P<id>\d*)\/edit\/?$/', 
						'controller' 	=> 'cms_home', 
					  	'action' 		=> 'edit', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/carousel\/(?P<id>\d*)\/delete\/?$/', 
						'controller' 	=> 'cms_home', 
					  	'action' 		=> 'delete', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/carousel\/(?P<id>\d*)\/delete-image\/?$/', 
						'controller' 	=> 'cms_home', 
					  	'action' 		=> 'deleteImage', 
					  	'layout' 		=> 'empty'
				),
				//Users
				array(	'url' 			=> '/^cms\/users\/?$/', 
						'controller' 	=> 'cms_users', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/users\/add\/?$/', 
						'controller' 	=> 'cms_users', 
					  	'action' 		=> 'add', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/users\/(?P<id>\d*)\/edit\/?$/', 
						'controller' 	=> 'cms_users', 
					  	'action' 		=> 'edit', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/users\/submit\/?((?P<id>\d*)\/?)$/', 
						'controller' 	=> 'cms_users', 
					  	'action' 		=> 'submit', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/users\/(?P<id>\d*)\/delete\/?$/', 
						'controller' 	=> 'cms_users', 
					  	'action' 		=> 'delete', 
					  	'layout' 		=> 'empty'
				),
				//Accomodation
				array(	'url' 			=> '/^cms\/accomodation\/?$/', 
						'controller' 	=> 'cms_accomodation', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/accomodation\/add\/?$/', 
						'controller' 	=> 'cms_accomodation', 
					  	'action' 		=> 'add', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/accomodation\/(?P<id>\d*)\/edit\/?$/', 
						'controller' 	=> 'cms_accomodation', 
					  	'action' 		=> 'edit', 
					  	'layout' 		=> 'cms'
				),
				//Duplicate - BAD CODING
				array(	'url' 			=> '/^cms\/accomodation\/edit\/?$/', 
						'controller' 	=> 'cms_accomodation', 
					  	'action' 		=> 'edit', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/accomodation\/submit\/?$/', 
						'controller' 	=> 'cms_accomodation', 
					  	'action' 		=> 'submit', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/accomodation\/(?P<id>\d*)\/delete\/?$/', 
						'controller' 	=> 'cms_accomodation', 
					  	'action' 		=> 'delete', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/accomodation\/(?P<id>\d*)\/delete-image\/?$/', 
						'controller' 	=> 'cms_accomodation', 
					  	'action' 		=> 'deleteImage', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/accomodation\/(?P<service_id>\d*)\/delete-service\/?$/', 
						'controller' 	=> 'cms_accomodation', 
					  	'action' 		=> 'deleteService', 
					  	'layout' 		=> 'empty'
				),
				//winter
				array(	'url' 			=> '/^cms\/winter\/?$/', 
						'controller' 	=> 'cms_winter', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/winter\/add\/?$/', 
						'controller' 	=> 'cms_winter', 
					  	'action' 		=> 'add', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/winter\/(?P<id>\d*)\/edit\/?$/', 
						'controller' 	=> 'cms_winter', 
					  	'action' 		=> 'edit', 
					  	'layout' 		=> 'cms'
				),
				//Duplicate - BAD CODING
				array(	'url' 			=> '/^cms\/winter\/edit\/?$/', 
						'controller' 	=> 'cms_winter', 
					  	'action' 		=> 'edit', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/winter\/submit\/?$/', 
						'controller' 	=> 'cms_winter', 
					  	'action' 		=> 'submit', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/winter\/(?P<id>\d*)\/delete\/?$/', 
						'controller' 	=> 'cms_winter', 
					  	'action' 		=> 'delete', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/winter\/(?P<id>\d*)\/delete-image\/?$/', 
						'controller' 	=> 'cms_winter', 
					  	'action' 		=> 'deleteImage', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/winter\/(?P<service_id>\d*)\/delete-service\/?$/', 
						'controller' 	=> 'cms_winter', 
					  	'action' 		=> 'deleteService', 
					  	'layout' 		=> 'empty'
				),
				//Destinations
				array(	'url' 			=> '/^cms\/destinations\/?$/', 
						'controller' 	=> 'cms_destinations', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/destinations\/add\/?$/', 
						'controller' 	=> 'cms_destinations', 
					  	'action' 		=> 'add', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/destinations\/(?P<id>\d*)\/edit\/?$/', 
						'controller' 	=> 'cms_destinations', 
					  	'action' 		=> 'edit', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/destinations\/submit\/?((?P<id>\d*)\/?)$/', 
						'controller' 	=> 'cms_destinations', 
					  	'action' 		=> 'submit', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/destinations\/(?P<id>\d*)\/delete\/?$/', 
						'controller' 	=> 'cms_destinations', 
					  	'action' 		=> 'delete', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/destinations\/set-visible\/?$/', 
						'controller' 	=> 'cms_destinations', 
					  	'action' 		=> 'setVisible', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/destinations\/(?P<id>\d*)\/position\/?$/', 
						'controller' 	=> 'cms_destinations', 
					  	'action' 		=> 'position', 
					  	'layout' 		=> 'empty'
				),
				//Accomodation type
				array(	'url' 			=> '/^cms\/accomodation_type\/?$/', 
						'controller' 	=> 'cms_accomodation_type', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/accomodation_type\/add\/?$/', 
						'controller' 	=> 'cms_accomodation_type', 
					  	'action' 		=> 'add', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/accomodation_type\/(?P<id>\d*)\/edit\/?$/', 
						'controller' 	=> 'cms_accomodation_type', 
					  	'action' 		=> 'edit', 
					  	'layout' 		=> 'cms'
				),
				//Duplicate - BAD CODING
				array(	'url' 			=> '/^cms\/accomodation_type\/edit\/?$/', 
						'controller' 	=> 'cms_accomodation_type', 
					  	'action' 		=> 'edit', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/accomodation_type\/(?P<date_id>\d*)\/delete-date\/?$/', 
						'controller' 	=> 'cms_accomodation_type', 
					  	'action' 		=> 'deleteDate', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/accomodation_type\/submit\/?$/', 
						'controller' 	=> 'cms_accomodation_type', 
					  	'action' 		=> 'submit', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/accomodation_type\/(?P<id>\d*)\/delete\/?$/', 
						'controller' 	=> 'cms_accomodation_type', 
					  	'action' 		=> 'delete', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/accomodation_type\/(?P<id>\d*)\/delete-image\/?$/', 
						'controller' 	=> 'cms_accomodation_type', 
					  	'action' 		=> 'deleteImage', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/accomodation_type\/(?P<id>\d*)\/delete-file\/?$/', 
						'controller' 	=> 'cms_accomodation_type', 
					  	'action' 		=> 'deleteFile', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/accomodation_type\/(?P<id>\d*)\/delete-image-second\/?$/', 
						'controller' 	=> 'cms_accomodation_type', 
					  	'action' 		=> 'deleteImageSecond', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/accomodation_type\/(?P<id>\d*)\/position\/?$/', 
						'controller' 	=> 'cms_accomodation_type', 
					  	'action' 		=> 'position', 
					  	'layout' 		=> 'empty'
				),
				//Events
				array(	'url' 			=> '/^cms\/events\/?$/', 
						'controller' 	=> 'cms_events', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/events\/add\/?$/', 
						'controller' 	=> 'cms_events', 
					  	'action' 		=> 'add', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/events\/(?P<id>\d*)\/edit\/?$/', 
						'controller' 	=> 'cms_events', 
					  	'action' 		=> 'edit', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/events\/submit\/?((?P<id>\d*)\/?)$/', 
						'controller' 	=> 'cms_events', 
					  	'action' 		=> 'submit', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/events\/(?P<id>\d*)\/delete\/?$/', 
						'controller' 	=> 'cms_events', 
					  	'action' 		=> 'delete', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/events\/(?P<id>\d*)\/delete-image\/?$/', 
						'controller' 	=> 'cms_events', 
					  	'action' 		=> 'deleteImage', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/events\/(?P<id>\d*)\/delete-file\/?$/', 
						'controller' 	=> 'cms_events', 
					  	'action' 		=> 'deleteFile', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/events\/ajax-set-main\/?$/', 
						'controller' 	=> 'cms_events', 
					  	'action' 		=> 'setMain', 
					  	'layout' 		=> 'empty'
				),
				//Rent a car
				array(	'url' 			=> '/^cms\/rent_a_car\/?$/', 
						'controller' 	=> 'cms_rent_a_car', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/rent_a_car\/add\/?$/', 
						'controller' 	=> 'cms_rent_a_car', 
					  	'action' 		=> 'add', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/rent_a_car\/(?P<id>\d*)\/edit\/?$/', 
						'controller' 	=> 'cms_rent_a_car', 
					  	'action' 		=> 'edit', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/rent_a_car\/submit\/?((?P<id>\d*)\/?)$/', 
						'controller' 	=> 'cms_rent_a_car', 
					  	'action' 		=> 'submit', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/rent_a_car\/(?P<id>\d*)\/delete\/?$/', 
						'controller' 	=> 'cms_rent_a_car', 
					  	'action' 		=> 'delete', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/rent_a_car\/(?P<id>\d*)\/delete-image\/?$/', 
						'controller' 	=> 'cms_rent_a_car', 
					  	'action' 		=> 'deleteImage', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/rent_a_car\/(?P<id>\d*)\/position\/?$/', 
						'controller' 	=> 'cms_rent_a_car', 
					  	'action' 		=> 'position', 
					  	'layout' 		=> 'empty'
				),
				//Online booking
				array(	'url' 			=> '/^cms\/online_booking\/?$/', 
						'controller' 	=> 'cms_online_booking', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/online_booking\/(?P<id>\d*)\/delete\/?$/', 
						'controller' 	=> 'cms_online_booking', 
					  	'action' 		=> 'delete', 
					  	'layout' 		=> 'empty'
				),
				//Carriere
				array(	'url' 			=> '/^cms\/carriere\/?$/', 
						'controller' 	=> 'cms_carriere', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/carriere\/(?P<id>\d*)\/delete\/?$/', 
						'controller' 	=> 'cms_carriere', 
					  	'action' 		=> 'delete', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/carriere\/position\/?$/', 
						'controller' 	=> 'cms_carriere', 
					  	'action' 		=> 'position', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/carriere\/add\/?$/', 
						'controller' 	=> 'cms_carriere', 
					  	'action' 		=> 'add', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/carriere\/(?P<id>\d*)\/edit\/?$/', 
						'controller' 	=> 'cms_carriere', 
					  	'action' 		=> 'edit', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/carriere\/submit\/?$/', 
						'controller' 	=> 'cms_carriere', 
					  	'action' 		=> 'submit', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/carriere\/(?P<id>\d*)\/del-pos\/?$/', 
						'controller' 	=> 'cms_carriere', 
					  	'action' 		=> 'deletePosition', 
					  	'layout' 		=> 'empty'
				),
				//Conditions
				array(	'url' 			=> '/^cms\/conditions\/?$/', 
						'controller' 	=> 'cms_conditions', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/conditions\/submit\/?$/', 
						'controller' 	=> 'cms_conditions', 
					  	'action' 		=> 'submit', 
					  	'layout' 		=> 'empty'
				),
				//Contact
				array(	'url' 			=> '/^cms\/contact\/?$/', 
						'controller' 	=> 'cms_contact', 
					  	'action' 		=> 'index', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/contact\/add\/?$/', 
						'controller' 	=> 'cms_contact', 
					  	'action' 		=> 'add', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/contact\/(?P<id>\d*)\/edit\/?$/', 
						'controller' 	=> 'cms_contact', 
					  	'action' 		=> 'edit', 
					  	'layout' 		=> 'cms'
				),
				array(	'url' 			=> '/^cms\/contact\/submit\/?$/', 
						'controller' 	=> 'cms_contact', 
					  	'action' 		=> 'submit', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/contact\/(?P<id>\d*)\/delete\/?$/', 
						'controller' 	=> 'cms_contact', 
					  	'action' 		=> 'delete', 
					  	'layout' 		=> 'empty'
				),
				array(	'url' 			=> '/^cms\/contact\/(?P<id>\d*)\/position\/?$/', 
						'controller' 	=> 'cms_contact', 
					  	'action' 		=> 'position', 
					  	'layout' 		=> 'empty'
				),
				
);
