<?php
/* @var $this DetalleejeController */
/* @var $data Detalleeje */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nroRuedas')); ?>:</b>
	<?php echo CHtml::encode($data->nroRuedas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idchasis')); ?>:</b>
	<?php echo CHtml::encode($data->idchasis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idposicionEje')); ?>:</b>
	<?php echo CHtml::encode($data->idposicionEje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />


</div>