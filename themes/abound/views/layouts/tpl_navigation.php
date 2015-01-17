<?php
$baseUrl = Yii::app()->baseUrl;
$prueba = Yii::app()->params['var'];


$sql = 'SELECT `logondate` FROM `cruge_user` WHERE iduser=' . Yii::app()->user->id;
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$value = $command->queryScalar();
$fecha = date('d-m-Y H:i', $value);

//(Yii::app()->getSession()->get('rolActual') == 'Estudiante') ? true : false
if (!Yii::app()->user->isGuest) {
    $id = Yii::app()->user->id;
    $consulta = Yii::app()->db->createCommand('SELECT itemname FROM `cruge_authassignment` WHERE `userid`=' . $id);
    $roles = $consulta->queryAll();
    $arrayInt = array();
    $nroRoles = 0;
    if (Yii::app()->getSession()->get('Iniciado') != "1" && !Yii::app()->user->isSuperAdmin) {
        Yii::app()->getSession()->add('rolActual', $roles[0]['itemname']);
        Yii::app()->getSession()->add('Iniciado', '1');
    } else {
        if (Yii::app()->user->isSuperAdmin)
            Yii::app()->getSession()->add('rolActual', 'Admin');
    }
    foreach ($roles as $r) {
        array_push($arrayInt, array('label' => $r['itemname'], 'url' => $baseUrl . '?nrol=' . $r['itemname']));
        $nroRoles++;
    }
} else {
    $arrayInt = array('label' => 'Invitado', 'url' => '#');
    Yii::app()->getSession()->add('rolActual', 'Invitado');
    $nroRoles = 0;
    Yii::app()->getSession()->add('Iniciado', '0');
}

if (isset($_GET['nrol']))
    Yii::app()->getSession()->add('rolActual', $_GET['nrol']);
    $currentRole = Yii::app()->getSession()->get('rolActual');
?>
<?php

$alertasPre = Yii::app()->db->createCommand('SELECT count(*) as total  from sgu_actividades a where (a.proximoKm-(select lectura from sgu_kilometraje where idvehiculo=a.idvehiculo order by id desc limit 1)<=0 or a.proximoFecha<=date(now())) and a.idestatus=2')->queryRow();

if($alertasPre["total"]>0){
	$spanPre='<span class="badge badge-important pull-right">'.$alertasPre["total"].'</span>';
	$diPre='/mttoPreventivo?ajax=head&filtro=4';
}
else{
	$spanPre='';
	$diPre='/mttoPreventivo';
}
$alertasCor = Yii::app()->db->createCommand('SELECT count(*) as total from sgu_reporteFalla where idestatus=8')->queryRow();

if($alertasCor["total"]>0){
	$spanCor='<span class="badge badge-important pull-right">'.$alertasCor["total"].'</span>';
	$diCor='/mttoCorrectivo?ajax=fallas&filtro=1';
}
else{
	$spanCor='';
	$diCor='/mttoCorrectivo';
}

?>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <!-- Be sure to leave the brand out there if you want it shown -->
            <a class="brand" href="<?php echo Yii::app()->baseUrl; ?>"><img src=" <?php echo Yii::app()->theme->baseUrl; ?>/img/logo-unet-blanco.png "  width="20px" height="20px"> FlotaUNET <small>Sistema para la gestión de flotas</small></a>

            <div class="nav-collapse">
                <?php
                
                if (Yii::app()->request->getParam("cid") == 1) {
                    
                }
                ?>              

                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array('class' => 'pull-right nav'),
                    'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                    'itemCssClass' => 'item-test',
                    'encodeLabel' => false,
                    'items' => array(
                        /*array('label' => 'Inicio', 'url' => array('/'), 
                            'visible' => !Yii::app()->user->isGuest),*/
							array('label' => 'Vehiculos', 'url' => array('/Vehiculo'), 
                            'visible' => !Yii::app()->user->isGuest),
							array('label' => 'Repuestos', 'url' => array('/repuesto'), 
                            'visible' => !Yii::app()->user->isGuest),
							array('label' => 'M.Preventivo'.$spanPre.'', 'url' => array($diPre), 
                            'visible' => !Yii::app()->user->isGuest),
							array('label' => 'M.Correctivo'.$spanCor.'', 'url' => array($diCor), 
                            'visible' => !Yii::app()->user->isGuest),
							array('label' => 'Combustible', 'url' => array('/Combustible'), 
                            'visible' => !Yii::app()->user->isGuest),
							array('label' => 'Neumáticos', 'url' => array('/neumaticos'), 
                            'visible' => !Yii::app()->user->isGuest),
							array('label' => 'Viajes', 'url' => array('/viajes'), 
                            'visible' => !Yii::app()->user->isGuest),
                        
                        //Menu de Super Admin
                        /*array('label' => 'Administrar<span class="caret"></span>', 'url' => '#', 
                            'visible' => Yii::app()->user->isSuperAdmin,
                            'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 
                            'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                            'items' => array(
                                array('label' => 'Crear Usuario', 'url' => array('/cruge/ui/usermanagementcreate')),
                                array('label' => 'Administrar Usuarios', 'url' => array('/cruge/ui/usermanagementadmin')),
                                array('label' => 'Listar Campos Perfil', 'url' => array('/cruge/ui/fieldsadminlist')),
                                array('label' => 'Crear Campo de Perfil', 'url' => array('/cruge/ui/fieldsadmincreate')),
                                array('label' => 'Crear Roles', 'url' => array('/cruge/ui/rbaclistroles')),
                                array('label' => 'Crear Tareas', 'url' => array('/cruge/ui/rbaclisttasks')),
                                array('label' => 'Crear Operaciones', 'url' => array('/cruge/ui/rbaclistops')),
                                array('label' => 'Asignar Roles', 'url' => array('/cruge/ui/rbacusersassignments')),
                                array('label' => 'Sesiones', 'url' => array('/cruge/ui/sessionadmin')),
                                array('label' => 'Opciones', 'url' => array('/cruge/ui/systemupdate')),
                            )),*/
                        
                     
                        

                        //Diferentes Menu Compartidos
                        /*array('label' => 'Mi Cuenta <span class="caret"></span>', 'url' => '#', 
                            'visible' => !Yii::app()->user->isGuest, 
                            'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 
                            'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                            'items' => array(
                                array('label' => 'Historial de Sesiones', 'url' => '#'),
                                array('label' => 'Perfil', 'url' => array('/cruge/ui/editprofile')),
                            )),*/
                        
                        array('label' => 'Iniciar', 'url' => array('/cruge/ui/login'), 
                            'visible' => Yii::app()->user->isGuest),
                        
                        array('label' => 'Cerrar Sesión (' . Yii::app()->user->name . ')', 
                            'url' => Yii::app()->user->ui->logoutUrl, 'visible' => !Yii::app()->user->isGuest),
                      ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>


<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">

            <!-- Cambio de Colores en la barra principal -->
            <div class="style-switcher pull-left">  
                <?php if (!Yii::app()->user->isGuest) { ?>
                    <span>Bienvenido <strong><?php echo Yii::app()->user->name ?></strong>. Último Inicio de Sesión: <?php echo $fecha; ?></span>
                    <?php
                } else {
                    ?>
                    <span>Bienvenido. Inicie sesión para acceder a sus opciones operacionales.</span>
                <?php } ?>
                <!--
            <a href="javascript:chooseStyle('none', 60)" checked="checked"><span class="style" style="background-color:#0088CC;"></span></a>
            <a href="javascript:chooseStyle('style2', 60)"><span class="style" style="background-color:#7c5706;"></span></a>
            <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#468847;"></span></a>
            <a href="javascript:chooseStyle('style4', 60)"><span class="style" style="background-color:#4e4e4e;"></span></a>
            <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
            <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
            <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>
                -->
            </div>
            <?php if (!Yii::app()->user->isGuest) { ?>
                <form class="navbar-search pull-right" action="">           	 
                    <!-- <input type="text" class="search-query span2" placeholder="Búsqueda..">      -->   
                </form>
            <?php } ?>
        </div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->

