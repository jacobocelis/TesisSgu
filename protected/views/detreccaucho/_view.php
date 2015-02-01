<?php
/* @var $this DetreccauchoController */
/* @var $data Detreccaucho */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('costoUnitario')); ?>:</b>
	<?php echo CHtml::encode($data->costoUnitario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('costoTotal')); ?>:</b>
	<?php echo CHtml::encode($data->costoTotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idrecursoCaucho')); ?>:</b>
	<?php echo CHtml::encode($data->idrecursoCaucho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iddetalleEventoCa')); ?>:</b>
	<?php echo CHtml::encode($data->iddetalleEventoCa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idunidad')); ?>:</b>
	<?php echo CHtml::encode($data->idunidad); ?>
	<br />


</div>