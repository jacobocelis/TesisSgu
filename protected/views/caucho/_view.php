<?php
/* @var $this CauchoController */
/* @var $data Caucho */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idmedidaCaucho')); ?>:</b>
	<?php echo CHtml::encode($data->idmedidaCaucho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idrin')); ?>:</b>
	<?php echo CHtml::encode($data->idrin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idpiso')); ?>:</b>
	<?php echo CHtml::encode($data->idpiso); ?>
	<br />


</div>