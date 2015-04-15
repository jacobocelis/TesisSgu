<?php
	/*
		$model:  es una instancia que implementa a ICrugeStoredUser
	*/
	$this->breadcrumbs=array(
	'Sesiones de usuario',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Sistema</strong></div>' , 'visible'=>'1'),
	array('label'=>'Crear usuario', 'url'=>array('/cruge/ui/usermanagementcreate')),
	array('label'=>'Administrar usuarios', 'url'=>array('/cruge/ui/usermanagementadmin')),
	array('label'=>'Sesiones de usuarios', 'url'=>array('/cruge/ui/sessionadmin')),
	array('label'=>'Perfil', 'url'=>array('/cruge/ui/editprofile')),
	array('label'=>'Bitácora', 'url'=>array('/cruge/ui/bitacora')),
);
?>
<div class='crugepanel '>
<div class="form">
<h1><?php echo ucwords(CrugeTranslator::t("sesiones de usuario"));?></h1>
<?php 
$this->widget(Yii::app()->user->ui->CGridViewClass, array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
		//'idsession',
		//array('name'=>'iduser','htmlOptions'=>array('width'=>'50px')),
		array('name'=>'sessionname','filter'=>''),
		array('name'=>'status','filter'=>array(1=>'Activa',0=>'Cerrada')
			,'value'=>'$data->status==1 ? \'activa\' : \'cerrada\' '),
		array('name'=>'created','type'=>'datetime'),
		array('name'=>'lastusage','type'=>'datetime'),
		array('name'=>'usagecount','type'=>'number'),
		array('name'=>'expire','type'=>'datetime'),
		'ipaddress',
		array(
			'header'=>'Opciones',
			'class'=>'CButtonColumn',
			'template' => '{delete}',
			'deleteConfirmation'=>CrugeTranslator::t("¿Esta seguro de eliminar esta sesión?"),
			'buttons' => array(
					'delete'=>array(
						'label'=>CrugeTranslator::t("eliminar sesión"),
						'imageUrl'=>Yii::app()->user->ui->getResource("delete.png"),
						'url'=>'array("sessionadmindelete","id"=>$data->getPrimaryKey())'
					),
				),	
		)	
	),
	'filter'=>$model,
));
?>
</div>
</div>