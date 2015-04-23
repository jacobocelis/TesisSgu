<?php
/* @var $this PosicionruedaController */
/* @var $data Posicionrueda */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('posicionRueda')); ?>:</b>
	<?php echo CHtml::encode($data->posicionRueda); ?>
	<br />


</div>