<?php
/* @var $this NeumaticosController */
/* @var $data Historicocaucho */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serial')); ?>:</b>
	<?php echo CHtml::encode($data->serial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idestatusCaucho')); ?>:</b>
	<?php echo CHtml::encode($data->idestatusCaucho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcaucho')); ?>:</b>
	<?php echo CHtml::encode($data->idcaucho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idmarcaCaucho')); ?>:</b>
	<?php echo CHtml::encode($data->idmarcaCaucho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idvehiculo')); ?>:</b>
	<?php echo CHtml::encode($data->idvehiculo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('iddetalleRueda')); ?>:</b>
	<?php echo CHtml::encode($data->iddetalleRueda); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idasigChasis')); ?>:</b>
	<?php echo CHtml::encode($data->idasigChasis); ?>
	<br />

	*/ ?>

</div>