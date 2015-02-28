<?php
/* @var $this TipocombustibleController */
/* @var $data Tipocombustible */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('combustible')); ?>:</b>
	<?php echo CHtml::encode($data->combustible); ?>
	<br />


</div>