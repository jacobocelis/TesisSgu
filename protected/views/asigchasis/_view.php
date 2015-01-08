<?php
/* @var $this AsigchasisController */
/* @var $data Asigchasis */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idchasis')); ?>:</b>
	<?php echo CHtml::encode($data->idchasis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idgrupo')); ?>:</b>
	<?php echo CHtml::encode($data->idgrupo); ?>
	<br />


</div>