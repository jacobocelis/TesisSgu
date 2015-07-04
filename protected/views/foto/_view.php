<?php
/* @var $this FotoController */
/* @var $data Foto */
?>

<div class="view">

	<?php 
	

	echo CHtml::image('data:image/jpeg;base64,'.$data->imagen ); ?>
	<div class="btn-right">
		<?php echo CHtml::link("Eliminar","#",array('class'=>'btn btn-primary','submit'=>array('delete','id'=>$data->id),'confirm'=>'Está seguro que desea eliminar la foto?')) ?>
	</div>
</div>