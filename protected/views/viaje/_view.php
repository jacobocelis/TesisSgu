<?php
/* @var $this ViajeController */
/* @var $data Viaje */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('distanciaKm')); ?>:</b>
	<?php echo CHtml::encode($data->distanciaKm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idOrigen')); ?>:</b>
	<?php echo CHtml::encode($data->idOrigen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idDestino')); ?>:</b>
	<?php echo CHtml::encode($data->idDestino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idtipo')); ?>:</b>
	<?php echo CHtml::encode($data->idtipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('viaje')); ?>:</b>
	<?php echo CHtml::encode($data->viaje); ?>
	<br />


</div>