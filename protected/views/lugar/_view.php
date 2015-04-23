<?php
/* @var $this LugarController */
/* @var $data Lugar */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lugar')); ?>:</b>
	<?php echo CHtml::encode($data->lugar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idestados')); ?>:</b>
	<?php echo CHtml::encode($data->idestados); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('primario')); ?>:</b>
	<?php echo CHtml::encode($data->primario); ?>
	<br />


</div>