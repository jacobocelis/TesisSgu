<?php
/* @var $this InsumoController */
/* @var $data Insumo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insumo')); ?>:</b>
	<?php echo CHtml::encode($data->insumo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipoInsumo')); ?>:</b>
	<?php echo CHtml::encode($data->tipoInsumo); ?>
	<br />


</div>