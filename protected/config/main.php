<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'FlotaUnet',
	
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
		'application.controllers.*',
        'application.components.*',
        'application.modules.cruge.components.*',
        'application.modules.cruge.extensions.crugemailer.*',
        'application.modules.rights.components.dataproviders.*',
		'application.components.validators.*',
		'application.extensions.eeditable.*',
		'application.extensions.EFullCalendar.*',
		'application.extensions.EYiiPdf.*',
		'application.extensions.includes.*',
		'application.extensions.yii-mail.YiiMailMessage',
		'application.extensions.yii-mail.*',
		'application.extensions.highcharts.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'cruge' => array(
            'tableprefix' => 'cruge_',
            // para que utilice a protected.modules.cruge.models.auth.CrugeAuthDefault.php
            //
				// en vez de 'default' pon 'authdemo' para que utilice el demo de autenticacion alterna
            // para saber mas lee documentacion de la clase modules/cruge/models/auth/AlternateAuthDemo.php
            //
				'availableAuthMethods' => array('default'),
            'availableAuthModes' => array('username', 'email'),
            // url base para los links de activacion de cuenta de usuario
            'baseUrl' => 'http://coco.com/',
            // NO OLVIDES PONER EN FALSE TRAS INSTALAR
            'debug' => false,
            'rbacSetupEnabled' => true,
            'allowUserAlways' => true,
            // MIENTRAS INSTALAS..PONLO EN: false
            // lee mas abajo respecto a 'Encriptando las claves'
            //
				'useEncryptedPassword' => false,
            // Algoritmo de la función hash que deseas usar
            // Los valores admitidos están en: http://www.php.net/manual/en/function.hash-algos.php
            'hash' => 'sha1',
            // Estos tres atributos controlan la redirección del usuario. Solo serán son usados si no
            // hay un filtro de sesion definido (el componente MiSesionCruge), es mejor usar un filtro.
            //  lee en la wiki acerca de:
            //   "CONTROL AVANZADO DE SESIONES Y EVENTOS DE AUTENTICACION Y SESION"
            //
				// ejemplo:
           		'afterLoginUrl'=>array('/site/index'),  //( !!! no olvidar el slash inicial / )
            //		'afterLogoutUrl'=>array('/site/page','view'=>'about'),
            //
				'afterLoginUrl' => null,
            'afterLogoutUrl' => null,
            'afterSessionExpiredUrl' => null,
            // manejo del layout con cruge.
            //
	   'loginLayout' => '//layouts/column2',
            'registrationLayout' => '//layouts/column2',
            'activateAccountLayout' => '//layouts/column2',
            'editProfileLayout' => '//layouts/column2', ///SE QUEDÓ EN ASIGNAR LAYOUTS PARA LOGIN
            // en la siguiente puedes especificar el valor "ui" o "column2" para que use el layout
            // de fabrica, es basico pero funcional.  si pones otro valor considera que cruge
            // requerirá de un portlet para desplegar un menu con las opciones de administrador.
            //
				'generalUserManagementLayout' => 'ui',
            // permite indicar un array con los nombres de campos personalizados, 
            // incluyendo username y/o email para personalizar la respuesta de una consulta a: 
            // $usuario->getUserDescription(); 
            'userDescriptionFieldsArray' => array('email'),
        ),
    ),
    // application components
    'components' => array(
		'mail' => array(
		 'class' => 'ext.yii-mail.YiiMail',
		 'transportType'=>'smtp',
		 'transportOptions'=>array(
		 'host'=>'smtp.gmail.com',
		 'username'=>'jacobo.celis@gmail.com',
		 'password'=>'91234652',
		 'port'=>'465',
		 'encryption'=>'ssl',
		 ),
		 'viewPath' => 'application.views.mail',
		 'logging' => true,
		 'dryRun' => false
		 ),
//
        //  IMPORTANTE:  asegurate de que la entrada 'user' (y format) que por defecto trae Yii
        //               sea sustituida por estas a continuación:
        //
            'user' => array(
            'allowAutoLogin' => true,
            'class' => 'application.modules.cruge.components.CrugeWebUser',
            'loginUrl' => array('/cruge/ui/login'),
        ),
		'ePdf' => array(
			'class' => 'ext.EYiiPdf.EYiiPdf',
			'params' => array(
			'mpdf' => array(
			'librarySourcePath' => 'application.vendor.mpdf.*',
			'constants' => array(
			'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
		),
			'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
			/*'defaultParams' => array( // More info: http://mpdf1.com/manual/index.php?tid=184
			'mode' => '', // This parameter specifies the mode of the new document.
			'format' => 'A4', // format A4, A5, ...
			'default_font_size' => 0, // Sets the default document font size in points (pt)
			'default_font' => '', // Sets the default font-family for the new document.
			'mgl' => 15, // margin_left. Sets the page margins for the new document.
			'mgr' => 15, // margin_right
			'mgt' => 16, // margin_top
			'mgb' => 16, // margin_bottom
			'mgh' => 9, // margin_header
			'mgf' => 9, // margin_footer
			'orientation' => 'P', // landscape or portrait orientation
			)*/
		),),),
		
        'authManager' => array(
            'class' => 'application.modules.cruge.components.CrugeAuthManager',
        ),
        'crugemailer' => array(
            'class' => 'application.modules.cruge.components.CrugeMailer',
            'mailfrom' => 'email-desde-donde-quieres-enviar-los-mensajes@xxxx.com',
            'subjectprefix' => 'Tu Encabezado del asunto - ',
            'debug' => true,
        ),
        'format' => array(
            'datetimeFormat' => "d M, Y h:m:s a",
        ),
        // uncomment the following to enable URLs in path-format (Acortador de URL | URL Amigables)     
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '.sgu',
            'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
        ),
        /* 'db' => array(
          'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
          ), */
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=tsg',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'correo@unet.edu.ve',
        'var'=>0,
    ),
    
    //Selección de Tema, Idioma de Programación e Idioma de la Página
    'theme' => 'abound',
    'language' => 'es',
    'sourceLanguage' => 'es',
);
?>