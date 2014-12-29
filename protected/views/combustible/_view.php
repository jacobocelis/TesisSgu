<?php
/* @var $this CombustibleController */
/* @var $data Historicocombustible */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('litros')); ?>:</b>
	<?php echo CHtml::encode($data->litros); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('costoTotal')); ?>:</b>
	<?php echo CHtml::encode($data->costoTotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idestacionServicio')); ?>:</b>
	<?php echo CHtml::encode($data->idestacionServicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idconductor')); ?>:</b>
	<?php echo CHtml::encode($data->idconductor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idvehiculo')); ?>:</b>
	<?php echo CHtml::encode($data->idvehiculo); ?>
	<br />


</div>