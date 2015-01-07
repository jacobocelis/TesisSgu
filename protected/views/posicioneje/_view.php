<?php
/* @var $this PosicionejeController */
/* @var $data Posicioneje */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('posicionEje')); ?>:</b>
	<?php echo CHtml::encode($data->posicionEje); ?>
	<br />


</div>