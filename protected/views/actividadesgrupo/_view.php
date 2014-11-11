<?php
/* @var $this ActividadesgrupoController */
/* @var $data Actividadesgrupo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actividad')); ?>:</b>
	<?php echo CHtml::encode($data->actividad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('frecuenciaKm')); ?>:</b>
	<?php echo CHtml::encode($data->frecuenciaKm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('frecuenciaMes')); ?>:</b>
	<?php echo CHtml::encode($data->frecuenciaMes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('frecuencia')); ?>:</b>
	<?php echo CHtml::encode($data->frecuencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duracion')); ?>:</b>
	<?php echo CHtml::encode($data->duracion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diasParo')); ?>:</b>
	<?php echo CHtml::encode($data->diasParo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('idplan')); ?>:</b>
	<?php echo CHtml::encode($data->idplan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idprioridad')); ?>:</b>
	<?php echo CHtml::encode($data->idprioridad); ?>
	<br />

	*/ ?>

</div>