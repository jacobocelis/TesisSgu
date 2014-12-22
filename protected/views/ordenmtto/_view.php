<?php
/* @var $this OrdenmttoController */
/* @var $data Ordenmtto */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idestatus')); ?>:</b>
	<?php echo CHtml::encode($data->idestatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taller')); ?>:</b>
	<?php echo CHtml::encode($data->taller); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cOperativo')); ?>:</b>
	<?php echo CHtml::encode($data->cOperativo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cTaller')); ?>:</b>
	<?php echo CHtml::encode($data->cTaller); ?>
	<br />


</div>