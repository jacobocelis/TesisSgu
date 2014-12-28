
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>FlotaUNET</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Free yii themes, free web application theme">
        <meta name="author" content="Webapplicationthemes.com">
        <!-- Fuente Local del Sitio Web -->
        

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <?php
		 $ruta=Yii::app()->request->baseUrl;
        $baseUrl = Yii::app()->theme->baseUrl;
        $cs = Yii::app()->getClientScript();
        Yii::app()->clientScript->registerCoreScript('jquery');
        ?>
		<link href='<?php echo $baseUrl;?>/css/font.css' rel='stylesheet' type='text/css'>
        <!-- Fav and Touch and touch icons -->
        <link rel="shortcut icon" href="<?php echo $baseUrl; ?>/img/icons/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl; ?>/img/icons/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl; ?>/img/icons/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl; ?>/img/icons/apple-touch-icon-57-precomposed.png">
        <?php
        $cs->registerCssFile($baseUrl . '/css/bootstrap.min.css');
        $cs->registerCssFile($baseUrl . '/css/bootstrap-responsive.min.css');
        $cs->registerCssFile($baseUrl . '/css/abound.css');
        //$cs->registerCssFile($baseUrl.'/css/style-blue.css');
        ?>
        <!-- styles for style switcher -->
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/style-blue.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style2" href="<?php echo $baseUrl; ?>/css/style-brown.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style3" href="<?php echo $baseUrl; ?>/css/style-green.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style4" href="<?php echo $baseUrl; ?>/css/style-grey.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style5" href="<?php echo $baseUrl; ?>/css/style-orange.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style6" href="<?php echo $baseUrl; ?>/css/style-purple.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style7" href="<?php echo $baseUrl; ?>/css/style-red.css" />
		
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.galleryview-3.0-dev.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.galleryview-3.0-dev.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-timepicker-addon.css" />

		
        <?php
        $cs->registerScriptFile($baseUrl . '/js/bootstrap.min.js');
        $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.sparkline.js');
        $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.flot.min.js');
        $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.flot.pie.min.js');
        $cs->registerScriptFile($baseUrl . '/js/charts.js');
        $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.knob.js');
        $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.masonry.min.js');
        $cs->registerScriptFile($baseUrl . '/js/styleswitcher.js');
		
		
        ?>
		
	<?php Yii::app()->getClientScript()->registerCoreScript( 'jquery' ); ?>
	<?php Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' ); ?>
	<?php Yii::app()->clientScript->registerScriptFile($ruta.'/js/jqFancyTransitions.1.8.js'); ?>	
	<?php Yii::app()->clientScript->registerScriptFile($ruta.'/js/jquery.easing.1.3.js'); ?>
	<?php Yii::app()->clientScript->registerScriptFile($ruta.'/js/jquery.galleryview-3.0-dev.js'); ?>
	<?php Yii::app()->clientScript->registerScriptFile($ruta.'/js/jquery.timers-1.2.js'); ?>
	<?php Yii::app()->clientScript->registerScriptFile($ruta.'/js/responsiveslides.js'); ?>
	<?php Yii::app()->clientScript->registerScriptFile($ruta.'/js/responsiveslides.min.js'); ?>
	<?php Yii::app()->clientScript->registerScriptFile($ruta.'/js/jquery-ui-timepicker.js'); ?>
	<?php Yii::app()->clientScript->registerScriptFile($ruta.'/js/jquery.scrollTo.min.js'); ?>
	<?php Yii::app()->clientScript->registerScriptFile($ruta.'/js/jquery.scrollTo.js'); ?>
	
    </head>

    <body>
        <?php echo Yii::app()->user->ui->displayErrorConsole(); ?>
        <section id="navigation-main">   
            <!-- Require the navigation -->
            <?php require_once('tpl_navigation.php');
            ?>
        </section><!-- /#navigation-main -->

        <section class="main-body">
            <div class="container-fluid">
                <!-- Include content pages -->
                <?php echo $content; ?>
            </div>
        </section>

        <!-- Require the footer -->
        <?php require_once('tpl_footer.php') ?>

    </body>
</html>