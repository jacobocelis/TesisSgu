<?php
/* @var $this MedidacauchoController */
/* @var $data Medidacaucho */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('medida')); ?>:</b>
	<?php echo CHtml::encode($data->medida); ?>
	<br />


</div>