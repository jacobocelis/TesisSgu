<?php
/* @var $this FallacauchoController */
/* @var $data Fallacaucho */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('falla')); ?>:</b>
	<?php echo CHtml::encode($data->falla); ?>
	<br />


</div>