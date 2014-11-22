<?php
/* @var $this DetallleordenController */
/* @var $data Detallleorden */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idactividades')); ?>:</b>
	<?php echo CHtml::encode($data->idactividades); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idordenMtto')); ?>:</b>
	<?php echo CHtml::encode($data->idordenMtto); ?>
	<br />


</div>