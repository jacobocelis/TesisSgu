<?php
/* @var $this DetalleactController */
/* @var $data Detalleact */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idfactura')); ?>:</b>
	<?php echo CHtml::encode($data->idfactura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iddetallleOrden')); ?>:</b>
	<?php echo CHtml::encode($data->iddetallleOrden); ?>
	<br />


</div>