<?php
/* @var $this SubtiporepuestoController */
/* @var $data Subtiporepuesto */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoRepuesto')); ?>:</b>
	<?php echo CHtml::encode($data->idTipoRepuesto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subTipo')); ?>:</b>
	<?php echo CHtml::encode($data->subTipo); ?>
	<br />


</div>