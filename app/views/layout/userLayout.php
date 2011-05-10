<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Belvi Travel 
        <?php 
        if($active == 'pocetna') echo "Belvi Travel - Letovanja, Zimovanja, Evropski gradovi, Daleke destinacije,Wellness&Spa, Koncerti";
        else echo (isset($active)?"&raquo; ".str_replace("-", " ", $active):"");?> <?php echo (isset($accType['acc_type']['name'])?"&raquo; ".$accType['acc_type']['name']:""); ?> <?php echo (isset($accom['acc'][0]['name'])?"&raquo; ".$accom['acc'][0]['name']:"");?>
        </title>
        <link rel="shortcut icon" href="<?php echo IMAGE_PATH.'favicon.ico'; ?>" type="image/x-icon" />
		<meta name="google-site-verification" content="CcjEnxKU3ujGzEP76C2xf0-RINrmRiZw5-wkHeG7ZMg" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Description" content="<?php echo (!empty($front['web_desc']) ? $front['web_desc'] : 'Belvi Travel. Turisticka agencija iz Beograda. Organizuje odmore i putovanja na destinacijama Mediterana, gradovima centralne Evrope i zemljama bliskog i dalekog istoka. Sajt sadrzi aktuelnu ponudu, cenovnik i mogucnost online rezervacije…');?>" />
	<meta name="Keywords" content="<?php echo (!empty($front['web_keywords']) ? $front['web_keywords'] : (isset($active)?"Belvi :: ".str_replace("-", " ", $active):"") . (isset($accType['acc_type']['name'])?":: ".$accType['acc_type']['name']:"") . (isset($accom['acc'][0]['name'])?" :: ".$accom['acc'][0]['name']:"") .' GRCKA 2011, KRF 2011, LETO 2011, KRF, LETOVANJE, Leto Spanija, Spanija 2011, Rodos letovanje, Letovanje Grcka, PUTOVANJA, Zakintos, Rodos 2011, Kefalonia, Turska Kusadasi, Alanja, Antalija, Krit, Tasos 2011, Kefalonija, Krit Retimno, Krit Hersonisos, Grcka, Krit 2011, Letovanje Krit, letovanje Krf, letovanje Tasos.'); ?>" />
     	<meta http-equiv="X-UA-Compatible" content="IE=7" />
        <meta name="author" content="belvi.rs" />
        <meta name="robots" content="index,follow" />
        <!-- Include jQuery -->
        <?php echo $html->js('jquery-1.4.2.min'); ?>
        <!-- slider -->
        <?php echo $html->js('coin-slider'); ?>
        <!--  tooltip -->
        <?php echo $html->js('jquery.tipsy'); ?>
        <!-- Default css file -->
        <?php echo $html->css('default'); ?>
        <!-- slider -->
        <?php echo $html->css('coin-slider-styles'); ?>
        <!-- tooltip css -->
        <?php echo $html->css('tipsy'); ?>
        
        <!-- Include cufon -->
        <?php echo $html->js('cufon'); ?>
        <?php echo $html->js('font'); ?>

        <!-- Default js file -->
        <?php echo $html->js('default'); ?>

        <?php
        //Custom calls for css
        echo $html->customCss($this->_css);

        //Custom calls for js
        echo $html->customJs($this->_js);
        ?>
        <script type="text/javascript">
            $(document).ready( function(){
    			
            	$('#banner').coinslider({  
    				opacity:0.7, 
    				effect: 'random',
    				spw: 7,
    				sph: 5, 
    				width:744, 
    				height:207, 
    				delay:5000, 
    				links :false 
    			});
    			
    			
                Cufon.replace('.up_nav li', { hover: true });
                Cufon.replace('.cufon', { hover: true });
                Cufon.replace('h1, h2, h3, h4, ');

                $('.tooltip').each(function(){
					$(this).tipsy({gravity: 'w'});
                });
            });
            function addBookmark(title,url) {
            	  if (window.sidebar)
            	    window.sidebar.addPanel(title, url,"");
            	  else if( document.all )
            	    window.external.AddFavorite( url, title);
            	  else
            	    return true;
            }
                     
        </script>
        <script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-20951194-1']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		</script>
    </head>
    <body class="bg">
    
    	<div class="wraper">
    		<div class="favorite_holder">
    			<div class="favorite"><a href="#" onclick="javascript:addBookmark('Belvi turistička agencija', window.location.href); return false;"><img src="<?php echo IMAGE_PATH.'favorites.png'; ?>" alt=""/> dodaj u favorite</a></div>
    		</div>
    		<div class="header">
    			<div style="float: left;">
    				<a href="<?php echo BASE_PATH; ?>">
						<img src="<?php echo IMAGE_PATH.'logo.png'; ?>" alt=""/>
					</a>
    			</div>
    			
				<!-- carousel - start -->
				<?php if(isset($mainCarousel) && !empty($mainCarousel)):?>
				<div id="banner" style="float: left;">
					<?php foreach($mainCarousel as $carousel):?>
	            		<img src="<?php echo FILE_PATH.'carousel'.DS.'resized'.DS.$carousel['id']."-".$carousel['image']; ?>" alt="<?php echo $carousel['name']; ?>" />
	            		<?php 
	            			switch($carousel['accomodation']){
	            				case 'summer': $acc = "letovanja"; break;
	            				case 'winter': $acc = "zimovanja"; break;
	            				case 'city_break': $acc = "evropski-gradovi"; break;
	            				case 'other': default: $acc = "specijalno"; break;
	            			}
	            		?>
	            		<span><a href="<?php echo ($carousel['accomodation_type'] == "" ? "#" : BASE_PATH.$acc.DS.$carousel['accomodation_type'].DS);?>"><?php echo $carousel['name']; ?></a></span>
	        		<?php endforeach;?>
			    </div>
			    <?php endif; ?>
			    <!-- carousel - end -->
	    	</div>
					
	    	<div class="up_menu">
	    		<div class="up_nav">
	    			<ul>
	    				<li><a <?php echo (isset($active) && $active=='pocetna' ? "class='active'" : ""); ?> href="<?php echo BASE_PATH; ?>">Početna</a></li>
	    				<li><a <?php echo (isset($active) && $active=='letovanja' ? "class='active'" : ""); ?> href="<?php echo BASE_PATH.'letovanja'.DS; ?>">Letovanje</a></li>
	    				<li><a <?php echo (isset($active) && $active=='zimovanja' ? "class='active'" : ""); ?> href="<?php echo BASE_PATH.'zimovanja'.DS; ?>">Zimovanje</a></li>
	    				<li><a <?php echo (isset($active) && $active=='evropski-gradovi' ? "class='active'" : ""); ?> href="<?php echo BASE_PATH.'evropski-gradovi'.DS; ?>">Evropski gradovi</a></li>
	    				<li><a <?php echo (isset($active) && $active=='destination' ? "class='active'" : ""); ?> href="<?php echo BASE_PATH.'daleke-destinacije'.DS; ?>">Daleke destinacije</a></li>
	    				<li><a <?php echo (isset($active) && $active=='wellness_and_spa' ? "class='active'" : ""); ?> href="<?php echo BASE_PATH.'wellness-and-spa'.DS; ?>">Wellness & Spa</a></li>
	    				<li><a <?php echo (isset($active) && $active=='dogadjaji' ? "class='active'" : ""); ?> href="<?php echo BASE_PATH.'dogadjaji'.DS; ?>">Koncerti</a></li>
	    				<li><a <?php echo (isset($active) && $active=='rezervacije' ? "class='active'" : ""); ?> href="<?php echo BASE_PATH.'rezervacije'.DS; ?>">On-line booking</a></li>
	    				<li><a <?php echo (isset($active) && $active=='kontakt' ? "class='active'" : ""); ?> href="<?php echo BASE_PATH.'kontakt'.DS; ?>">Kontakt</a></li>	    				
	    				
	    			</ul>
	    		</div>
	    		
	    		
	    	</div>
	    	<div style="clear:both;"><!-- clear --></div>
	    	<div class="main">
	
				<!-- Loading left main menu -->
				<?php include_once VIEW_PATH.'home'.DS.'_leftMainMenu.php';?>	    		
	    		
			    <!-- This is a content that will be included on page inside of this layout -->
				<?php if(file_exists(VIEW_PATH.$this->_controller.DS.$this->_action.'View.php')) include (VIEW_PATH.$this->_controller.DS.$this->_action.'View.php'); ?>
				
				<div class="footer">
					<div class="footer_links">
						<span class="footer_a"><a href="#">Vrh strane</a></span>
						<span class="footer_line"> | </span>
						<span class="footer_a"><a href="<?php echo BASE_PATH.'uslovi'.DS; ?>">  Opšti uslovi putovanja</a></span>
						<span class="footer_line"> | </span>
						<span class="footer_a"><a href="<?php echo BASE_PATH.'kontakt'.DS; ?>">Kontakt</a></span>
					</div>
					<div class="footer_copuright">Copyright ©2011 Belvi Travel</div>
					<div class="design_by"><a href="http://www.blue-designs.rs" target="_blank">Design by <br/>Blue Designs</a></div>
				</div>
				<div class="address_footer">
					<div class="address_box_footer">
						<p>Poslovnica Stari Grad (centar):</p>
						<p>11000 Beograd, Kosovska 9</p>
	
						<p>tel./fax:
						(011) 322-3300; 3340-888
						(011) 3224-198; 3342-331</p>
						
						<p>mail:
						belvitravel@belvi.rs</p>
						
						
						<p>www.belvi.rs</p>
						
					
					
					</div>
					<div class="address_box_footer">
						<p>Poslovnica Novi Beograd (naselje Belville):</p>
						<p>11070 Novi Beograd, Jurija Gagarina 12b</p>
	
						<p>tel./fax:
						((011) 6302-066; 6302-067</p>
						
						<p>mail:
						belvitravelnbg@belvi.rs</p>
						
						
						<p>www.belvi.rs</p>
						
					
					
					</div>
					<div class="address_box_footer">
						<p>Poslovnica Mirijevo </p>
						<p>11060 Beograd, Koste Nađa 8b</p>
	
						<p>tel./fax:
						(011) 3433-706; 3431-535</p>
						
						<p>mail:
						volare.travel@volare-travel.co.rs</p>
						
						
						<p>www.belvi.rs</p>
						
					
					
					</div>
				
				</div>
			</div>
		</div>
	
     <?php if(isset($_GET['q'])):?>
        <!-- Status msg -->
            <?php
            switch($_GET['q']) {
            //Success
                case 'success':?>
        <div id="j_message" class="msg success"><?php echo "Vaš zahtev je uspešno obrađen"; ?></div>
                    <?php
                    break;
                //Error
                case 'error':?>
        <div id="j_message" class="msg error"><?php echo "Došlo je do greške u vašem zahtevu"; ?></div>
					<?php 
                    break;
                default: //Error
                    break;
            }?>
        <script language="javascript" type="text/javascript">
            //FadeIn and FadeOut for messages
            $(document).ready(function(){
                $("#j_message").fadeIn(500).fadeOut(5000);
            });
        </script>
        <?php endif; ?>
    </body>
</html>
