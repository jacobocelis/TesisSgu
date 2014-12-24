<?php
/* @var $this RecursofallaController */
/* @var $data Recursofalla */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('idinsumo')); ?>:</b>
	<?php echo CHtml::encode($data->idinsumo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idservicio')); ?>:</b>
	<?php echo CHtml::encode($data->idservicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idrepuesto')); ?>:</b>
	<?php echo CHtml::encode($data->idrepuesto); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('idreporteFalla')); ?>:</b>
	<?php echo CHtml::encode($data->idreporteFalla); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idunidad')); ?>:</b>
	<?php echo CHtml::encode($data->idunidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('garantia')); ?>:</b>
	<?php echo CHtml::encode($data->garantia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idtiempo')); ?>:</b>
	<?php echo CHtml::encode($data->idtiempo); ?>
	<br />

	*/ ?>

</div>