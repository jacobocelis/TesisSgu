<?php
/* @var $this GrupoController */
/* @var $data Grupo */
?>

<div class="view">



	<b><?php echo CHtml::encode($data->getAttributeLabel('grupo')); ?>:</b>
	<?php echo CHtml::encode($data->grupo); ?>
	<br />

	</b>
	<?php echo CHtml::link(CHtml::encode('Toda la información'), array('view', 'id'=>$data->id)); ?>
	<br />


</div>