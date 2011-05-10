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

        <!-- Default css file -->
        <?php echo $html->css('default-cms'); ?>

        <!-- Default js file -->
        <?php echo $html->js('default-login'); ?>

        <?php
        //Custom calls for css
        echo $html->customCss($this->_css);

        //Custom calls for js
        echo $html->customJs($this->_js);
        ?>
    </head>
    <body>
        <!-- This is a content that will be included on page inside of this layout -->
        <?php if(file_exists(VIEW_PATH.$this->_controller.DS.$this->_action.'View.php')) include (VIEW_PATH.$this->_controller.DS.$this->_action.'View.php'); ?>
    	
        <?php if(isset($_GET['q'])):?>
        <!-- Status msg -->
		<?php 
		switch($_GET['q']) {
            //Success
            case 'success':?>
        	<div id="j_message" class="msg success"><?php "Vaš zahtev je uspešno obrađen"; ?></div>
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
