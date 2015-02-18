<?php
/* @var $this ServicioController */
/* @var $data Servicio */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('servicio')); ?>:</b>
	<?php echo CHtml::encode($data->servicio); ?>
	<br />


</div>