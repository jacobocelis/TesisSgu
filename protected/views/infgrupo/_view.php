<?php
/* @var $this InfgrupoController */
/* @var $data Infgrupo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('informacion')); ?>:</b>
	<?php echo CHtml::encode($data->informacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idgrupo')); ?>:</b>
	<?php echo CHtml::encode($data->idgrupo); ?>
	<br />


</div>