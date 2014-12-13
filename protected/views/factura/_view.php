<?php
/* @var $this FacturaController */
/* @var $data Factura */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaFactura')); ?>:</b>
	<?php echo CHtml::encode($data->fechaFactura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::encode($data->codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idproveedor')); ?>:</b>
	<?php echo CHtml::encode($data->idproveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idordenMtto')); ?>:</b>
	<?php echo CHtml::encode($data->idordenMtto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iva')); ?>:</b>
	<?php echo CHtml::encode($data->iva); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('totalFactura')); ?>:</b>
	<?php echo CHtml::encode($data->totalFactura); ?>
	<br />

	*/ ?>

</div>