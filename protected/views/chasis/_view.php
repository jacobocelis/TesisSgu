<?php
/* @var $this ChasisController */
/* @var $data Chasis */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nroEjes')); ?>:</b>
	<?php echo CHtml::encode($data->nroEjes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidadNormales')); ?>:</b>
	<?php echo CHtml::encode($data->cantidadNormales); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidadRepuesto')); ?>:</b>
	<?php echo CHtml::encode($data->cantidadRepuesto); ?>
	<br />


</div>