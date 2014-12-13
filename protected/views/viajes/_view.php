<?php
/* @var $this ViajesController */
/* @var $data Historicoviajes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horaSalida')); ?>:</b>
	<?php echo CHtml::encode($data->horaSalida); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horaLlegada')); ?>:</b>
	<?php echo CHtml::encode($data->horaLlegada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idviaje')); ?>:</b>
	<?php echo CHtml::encode($data->idviaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idvehiculo')); ?>:</b>
	<?php echo CHtml::encode($data->idvehiculo); ?>
	<br />


</div>