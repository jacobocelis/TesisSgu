<?php
/* @var $this ReportefallaController */
/* @var $data Reportefalla */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detalle')); ?>:</b>
	<?php echo CHtml::encode($data->detalle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaFalla')); ?>:</b>
	<?php echo CHtml::encode($data->fechaFalla); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaRealizada')); ?>:</b>
	<?php echo CHtml::encode($data->fechaRealizada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kmRealizada')); ?>:</b>
	<?php echo CHtml::encode($data->kmRealizada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diasParo')); ?>:</b>
	<?php echo CHtml::encode($data->diasParo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idtiempo')); ?>:</b>
	<?php echo CHtml::encode($data->idtiempo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('idvehiculo')); ?>:</b>
	<?php echo CHtml::encode($data->idvehiculo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idempleado')); ?>:</b>
	<?php echo CHtml::encode($data->idempleado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idfalla')); ?>:</b>
	<?php echo CHtml::encode($data->idfalla); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idestatus')); ?>:</b>
	<?php echo CHtml::encode($data->idestatus); ?>
	<br />

	*/ ?>

</div>