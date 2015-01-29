<?php
/* @var $this RotacioncauchosController */
/* @var $data Rotacioncauchos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('costoTotal')); ?>:</b>
	<?php echo CHtml::encode($data->costoTotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaRealizada')); ?>:</b>
	<?php echo CHtml::encode($data->fechaRealizada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idestatus')); ?>:</b>
	<?php echo CHtml::encode($data->idestatus); ?>
	<br />


</div>