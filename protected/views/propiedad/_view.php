<?php
/* @var $this PropiedadController */
/* @var $data Propiedad */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('propiedad')); ?>:</b>
	<?php echo CHtml::encode($data->propiedad); ?>
	<br />


</div>