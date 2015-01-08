<?php
/* @var $this CauchorepController */
/* @var $data Cauchorep */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idchasis')); ?>:</b>
	<?php echo CHtml::encode($data->idchasis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcaucho')); ?>:</b>
	<?php echo CHtml::encode($data->idcaucho); ?>
	<br />


</div>