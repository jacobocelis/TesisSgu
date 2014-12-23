<?php
/* @var $this FallaController */
/* @var $data Falla */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('falla')); ?>:</b>
	<?php echo CHtml::encode($data->falla); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idtipoFalla')); ?>:</b>
	<?php echo CHtml::encode($data->idtipoFalla); ?>
	<br />


</div>