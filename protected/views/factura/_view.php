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


</div>