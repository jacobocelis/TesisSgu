<?php
/* @var $this DetalleeventocaController */
/* @var $data Detalleeventoca */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaFalla')); ?>:</b>
	<?php echo CHtml::encode($data->fechaFalla); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaRealizada')); ?>:</b>
	<?php echo CHtml::encode($data->fechaRealizada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario')); ?>:</b>
	<?php echo CHtml::encode($data->comentario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idhistoricoCaucho')); ?>:</b>
	<?php echo CHtml::encode($data->idhistoricoCaucho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idfallaCaucho')); ?>:</b>
	<?php echo CHtml::encode($data->idfallaCaucho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idaccionCauho')); ?>:</b>
	<?php echo CHtml::encode($data->idaccionCauho); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('idestatus')); ?>:</b>
	<?php echo CHtml::encode($data->idestatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idempleado')); ?>:</b>
	<?php echo CHtml::encode($data->idempleado); ?>
	<br />

	*/ ?>

</div>