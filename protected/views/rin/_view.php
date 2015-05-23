<?php
/* @var $this RinController */
/* @var $data Rin */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rin')); ?>:</b>
	<?php echo CHtml::encode($data->rin); ?>
	<br />


</div>