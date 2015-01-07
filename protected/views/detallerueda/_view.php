<?php
/* @var $this DetalleruedaController */
/* @var $data Detallerueda */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idposicionRueda')); ?>:</b>
	<?php echo CHtml::encode($data->idposicionRueda); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iddetalleEje')); ?>:</b>
	<?php echo CHtml::encode($data->iddetalleEje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcaucho')); ?>:</b>
	<?php echo CHtml::encode($data->idcaucho); ?>
	<br />


</div>