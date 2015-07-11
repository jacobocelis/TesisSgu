<?php
/* @var $this MetasController */
/* @var $data Metas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TMEF')); ?>:</b>
	<?php echo CHtml::encode($data->TMEF); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TMPR')); ?>:</b>
	<?php echo CHtml::encode($data->TMPR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DISP')); ?>:</b>
	<?php echo CHtml::encode($data->DISP); ?>
	<br />


</div>