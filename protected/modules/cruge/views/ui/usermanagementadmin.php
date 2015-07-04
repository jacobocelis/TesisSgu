<?php
	/*
		$model:  es una instancia que implementa a ICrugeStoredUser
	*/
	$this->breadcrumbs=array(
	'Administrar usuarios',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Sistema</strong></div>' , 'visible'=>'1'),
	//array('label'=>'Crear usuario', 'url'=>array('/cruge/ui/usermanagementcreate')),
	array('label'=>'Administrar usuarios', 'url'=>array('/cruge/ui/usermanagementadmin')),
	array('label'=>'Sesiones de usuarios', 'url'=>array('/cruge/ui/sessionadmin')),
	array('label'=>'Perfil', 'url'=>array('/cruge/ui/editprofile')),
	array('label'=>'Bitácora', 'url'=>array('/cruge/ui/bitacora')),
);
?>

<div class='crugepanel '>
<div class="form">
<h1><?php echo ucwords(CrugeTranslator::t('admin', 'Administrar usuarios'));?></h1>
<?php 

	

/*
	para darle los atributos al CGridView de forma de ser consistente con el sistema Cruge
	es mejor preguntarle al Factory por los atributos disponibles, esto es porque si se decide
	cambiar la clase de CrugeStoredUser por otra entonces asi no haya dependenci directa a los
	campos.
*/
$cols = array();

// presenta los campos de ICrugeStoredUser
foreach(Yii::app()->user->um->getSortFieldNamesForICrugeStoredUser() as $key=>$fieldName){
	$value=null; // default
	$filter=null; // default, textbox
	$type='text';
	if($fieldName == 'state'){
		$value = '$data->getStateNameColor()';
		$filter = Yii::app()->user->um->getUserStateOptions();
		$type='raw';
	}
	if($fieldName == 'logondate'){
		$type='datetime';
	}
	if(($fieldName<>'iduser'))
	$cols[] = array('name'=>$fieldName,'value'=>$value,'filter'=>$filter,'type'=>$type);
}
	
$cols[] = array(
	'class'=>'CButtonColumn',
	
	'template' => '{update} {eliminar}',
	'deleteConfirmation'=>CrugeTranslator::t('admin', 'Are you sure you want to delete this user'),
	'header'=>'Opciones',
	'buttons' => array(

			'update'=>array(
				'label'=>CrugeTranslator::t('admin', 'Update User'),
				'url'=>'array("usermanagementupdate","id"=>$data->getPrimaryKey())'
			),
			'eliminar'=>array(
				'label'=>CrugeTranslator::t('admin', 'Delete User'),
				'imageUrl'=>Yii::app()->user->ui->getResource("delete.png"),
				'url'=>'array("usermanagementdelete","id"=>$data->getPrimaryKey())',
				'options' => array('class' => 'delete')
			),
		),	
);
$this->widget(Yii::app()->user->ui->CGridViewClass, 
	array(
    'dataProvider'=>$dataProvider,
    'columns'=>$cols,
	'filter'=>$model,
));
?>
</div>
</div>