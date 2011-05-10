<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Administrativni panel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=7" />
        <link rel="shortcut icon" href="<?php echo IMAGE_PATH.'favicon.ico'; ?>" type="image/x-icon" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="robots" content="index,follow" />
        <!-- Include jQuery -->
        <?php echo $html->js('jquery-1.4.2.min'); ?>

        <!-- Tooltip plugin -->
        <?php echo $html->js('tooltip'); ?>

        <!-- Default css file -->
        <?php echo $html->css('default-cms'); ?>

        <!-- Default js file -->
        <?php echo $html->js('default-cms'); ?>

        <?php
        //Custom calls for css
        echo $html->customCss($this->_css);

        //Custom calls for js
        echo $html->customJs($this->_js);
        ?>
    </head>
    <body>
        <div id="page">
            <div class="content">
            <div class="header">
                <div class="logo">
                    <h2>Belvi admin panel</h2>
                </div>
            </div>
            
                <!-- start sidebar -->
                <div id="sidebar">
                    <ul>
                        <li>
                            <a href="javascript:;" class="submenu-action" id="submenu-home">Naslovna</a>
                            <ul class="submenu <?php echo (isset($active) && $active == 'home' ? "show" : "hide"); ?>" id="home" <?php echo (isset($active) && $active == 'home' ? "" : "style='display: none;'"); ?>>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS; ?>">Početna stranica</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'carousel'.DS; ?>">Pregled glavne reklame</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'carousel'.DS.'add'; ?>">Dodavanje glavne reklame</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="submenu-action" id="submenu-users">Korisnici</a>
                            <ul class="submenu <?php echo (isset($active) && $active == 'users' ? "show" : "hide"); ?>" id="users" <?php echo (isset($active) && $active == 'users' ? "" : "style='display: none;'"); ?>>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'users'.DS; ?>">Pregled postojećih</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'users'.DS.'add'.DS; ?>">Dodavanje novih</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="submenu-action" id="submenu-destinations">Destinacije</a>
                            <ul class="submenu <?php echo (isset($active) && $active == 'destinations' ? "show" : "hide"); ?>" id="destinations" <?php echo (isset($active) && $active == 'destinations' ? "" : "style='display: none;'"); ?>>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'destinations'.DS; ?>">Pregled postojećih</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'destinations'.DS.'add'.DS; ?>">Dodavanje novih</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="submenu-action" id="submenu-accomodation_type">Tip aranžmana</a>
                            <ul class="submenu <?php echo (isset($active) && $active == 'accomodation_type' ? "show" : "hide"); ?>" id="accomodation_type" <?php echo (isset($active) && $active == 'accomodation_type' ? "" : "style='display: none;'"); ?>>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'accomodation_type'.DS; ?>">Pregled postojećih</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'accomodation_type'.DS.'add'.DS; ?>">Dodavanje novih</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="submenu-action" id="submenu-accomodation">Aranžmani</a>
                            <ul class="submenu <?php echo (isset($active) && $active == 'accomodation' ? "show" : "hide"); ?>" id="accomodation" <?php echo (isset($active) && $active == 'accomodation' ? "" : "style='display: none;'"); ?>>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'accomodation'.DS; ?>">Pregled postojećih</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'accomodation'.DS.'add'.DS; ?>">Dodavanje novih</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="submenu-action" id="submenu-events">Koncerti</a>
                            <ul class="submenu <?php echo (isset($active) && $active == 'events' ? "show" : "hide"); ?>" id="events" <?php echo (isset($active) && $active == 'events' ? "" : "style='display: none;'"); ?>>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'events'.DS; ?>">Pregled postojećih</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'events'.DS.'add'.DS; ?>">Dodavanje novih</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="submenu-action" id="submenu-rent_a_car">Rent a car</a>
                            <ul class="submenu <?php echo (isset($active) && $active == 'rent_a_car' ? "show" : "hide"); ?>" id="rent_a_car" <?php echo (isset($active) && $active == 'rent_a_car' ? "" : "style='display: none;'"); ?>>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'rent_a_car'.DS; ?>">Pregled postojećih</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'rent_a_car'.DS.'add'.DS; ?>">Dodavanje novih</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="submenu-action" id="submenu-online_booking">Rezervacije</a>
                            <ul class="submenu <?php echo (isset($active) && $active == 'online_booking' ? "show" : "hide"); ?>" id="online_booking" <?php echo (isset($active) && $active == 'online_booking' ? "" : "style='display: none;'"); ?>>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'online_booking'.DS; ?>">Pregled pristiglih</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="submenu-action" id="submenu-carriere">Zaposlenje
                            <?php if(isset($numOfCandidats) && $numOfCandidats['num'] > 0):?>
                            <span style="color: #FF0000;">(<b><?php echo $numOfCandidats['num'];?></b>)</span>
                            <?php endif;?>
                            </a>
                            <ul class="submenu <?php echo (isset($active) && $active == 'carriere' ? "show" : "hide"); ?>" id="carriere" <?php echo (isset($active) && $active == 'carriere' ? "" : "style='display: none;'"); ?>>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'carriere'.DS.'position'.DS; ?>">Pregled postojećih</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'carriere'.DS.'add'.DS; ?>">Dodavanje novih</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'carriere'.DS; ?>">Pregled pristiglih prijava</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="submenu-action" id="submenu-conditions">Uslovi</a>
                            <ul class="submenu <?php echo (isset($active) && $active == 'conditions' ? "show" : "hide"); ?>" id="conditions" <?php echo (isset($active) && $active == 'conditions' ? "" : "style='display: none;'"); ?>>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'conditions'.DS; ?>">Pregled uslova</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="submenu-action" id="submenu-contact">Kontakt</a>
                            <ul class="submenu <?php echo (isset($active) && $active == 'contact' ? "show" : "hide"); ?>" id="contact" <?php echo (isset($active) && $active == 'contact' ? "" : "style='display: none;'"); ?>>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'contact'.DS; ?>">Pregled postojećih</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_PATH.'cms'.DS.'contact'.DS.'add'.DS; ?>">Dodavanje novih</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH.'logout'.DS; ?>" class="logout">Odjava</a>
                        </li>
                    </ul>
                </div>
                <!-- start content -->
                <div id="content">
                    <!-- This is a content that will be included on page inside of this layout -->
                    <?php if(file_exists(VIEW_PATH.$this->_controller.DS.$this->_action.'View.php')) include (VIEW_PATH.$this->_controller.DS.$this->_action.'View.php'); ?>
                </div>
                <!-- end content -->


                <div class="footer">
                    <div class="copy">Belvi &copy; Copyright 2010. All rights reserved.</div>
                    <div class="links">
                        <a href="#">Nazad na sajt</a>
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
        <div id="j_message" class="msg success"><?php echo "Vaš¡ zahtev je uspešno obrađen"; ?></div>
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
