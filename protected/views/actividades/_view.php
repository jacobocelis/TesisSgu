<?php
/* @var $this ActividadesController */
/* @var $data Actividades */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actividad')); ?>:</b>
	<?php echo CHtml::encode($data->actividad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ultimoKm')); ?>:</b>
	<?php echo CHtml::encode($data->ultimoKm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ultimoFecha')); ?>:</b>
	<?php echo CHtml::encode($data->ultimoFecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('frecuenciaKm')); ?>:</b>
	<?php echo CHtml::encode($data->frecuenciaKm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('frecuenciaMes')); ?>:</b>
	<?php echo CHtml::encode($data->frecuenciaMes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proximoKm')); ?>:</b>
	<?php echo CHtml::encode($data->proximoKm); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('proximoFecha')); ?>:</b>
	<?php echo CHtml::encode($data->proximoFecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duracion')); ?>:</b>
	<?php echo CHtml::encode($data->duracion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('atraso')); ?>:</b>
	<?php echo CHtml::encode($data->atraso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idprioridad')); ?>:</b>
	<?php echo CHtml::encode($data->idprioridad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idplan')); ?>:</b>
	<?php echo CHtml::encode($data->idplan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idtiempod')); ?>:</b>
	<?php echo CHtml::encode($data->idtiempod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idtiempof')); ?>:</b>
	<?php echo CHtml::encode($data->idtiempof); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idactividadesGrupo')); ?>:</b>
	<?php echo CHtml::encode($data->idactividadesGrupo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idestatus')); ?>:</b>
	<?php echo CHtml::encode($data->idestatus); ?>
	<br />

	*/ ?>

</div>