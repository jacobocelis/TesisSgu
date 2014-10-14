<?php
/* @var $this RepuestoController */
/* @var $data Repuesto */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('Tipo de repuesto')); ?>:</b>
	<?php echo CHtml::encode($data->idsubTipoRepuesto0->idTipoRepuesto0->tipo); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('idsubTipoRepuesto')); ?>:</b>
	<?php echo CHtml::encode($data->idsubTipoRepuesto0->subTipo); ?>
	<br />
	
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('repuesto')); ?>:</b>
	<?php echo CHtml::encode($data->repuesto); ?>
	<br />
	


</div>