<?php
/* @var $this ActividadrecursogrupoController */
/* @var $data Actividadrecursogrupo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idactividadesGrupo')); ?>:</b>
	<?php echo CHtml::encode($data->idactividadesGrupo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idinsumo')); ?>:</b>
	<?php echo CHtml::encode($data->idinsumo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idprovServ')); ?>:</b>
	<?php echo CHtml::encode($data->idprovServ); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idrepuesto')); ?>:</b>
	<?php echo CHtml::encode($data->idrepuesto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idunidad')); ?>:</b>
	<?php echo CHtml::encode($data->idunidad); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('detalle')); ?>:</b>
	<?php echo CHtml::encode($data->detalle); ?>
	<br />

	*/ ?>

</div>