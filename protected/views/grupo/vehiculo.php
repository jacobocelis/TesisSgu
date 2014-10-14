<?php
/* @var $this VehiculoController */
/* @var $data Vehiculo */
?>

<div class="view">


	<b><?php echo CHtml::encode($data->getAttributeLabel('numeroUnidad')); ?>:</b>
	<?php echo CHtml::encode($data->numeroUnidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('placa')); ?>:</b>
	<?php echo CHtml::encode($data->placa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anno')); ?>:</b>
	<?php echo CHtml::encode($data->anno); ?>
	<br />
	
		<b></b>
	<?php echo CHtml::link(CHtml::encode('Toda la información'), array('vehiculo/view/'.$data->id)); ?>
	<br />

	<?php
		

	/*
	<b><?php echo CHtml::encode($data->getAttributeLabel('nroEjes')); ?>:</b>
	<?php echo CHtml::encode($data->nroEjes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('capCarga')); ?>:</b>
	<?php echo CHtml::encode($data->capCarga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario')); ?>:</b>
	<?php echo CHtml::encode($data->comentario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidadRuedas')); ?>:</b>
	<?php echo CHtml::encode($data->cantidadRuedas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('capTanque')); ?>:</b>
	<?php echo CHtml::encode($data->capTanque); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idmodelo')); ?>:</b>
	<?php echo CHtml::encode($data->idmodelo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idgrupo')); ?>:</b>
	<?php echo CHtml::encode($data->idgrupo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcombustible')); ?>:</b>
	<?php echo CHtml::encode($data->idcombustible); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaRegistro')); ?>:</b>
	<?php echo CHtml::encode($data->fechaRegistro); ?>
	<br />

	*/ ?>

</div>