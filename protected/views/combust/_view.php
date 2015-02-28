<?php
/* @var $this CombustController */
/* @var $data Combust */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('costoLitro')); ?>:</b>
	<?php echo CHtml::encode($data->costoLitro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idtipoCombustible')); ?>:</b>
	<?php echo CHtml::encode($data->idtipoCombustible); ?>
	<br />


</div>