<?php
/* @var $this NeumaticosController */
/* @var $model Historicocaucho */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historicocaucho-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'serial'); ?>
		<?php echo $form->textField($model,'serial',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'serial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idestatusCaucho'); ?>
		<?php echo $form->textField($model,'idestatusCaucho'); ?>
		<?php echo $form->error($model,'idestatusCaucho'); ?>
	</div>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'vehiculos71',
				'summaryText'=>'',
				//se deben definir inicialmente los neumaticos que posee cada vehiculo
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay registros',
                'dataProvider'=>$montados,
				'htmlOptions'=>array('style'=>'margin-top:10px;float: left;width:100%'),
				'columns'=>array(
				array(
					'class'=>'CCheckBoxColumn'
				),
				array(
					'type'=>"raw",
					'header'=>'Fecha de montaje',
					'value'=>'$data->fecha=="0000-01-01"?$data->porDefinir($data->fecha):date("d/m/Y",strtotime($data->fecha))',
					'name'=>'fecha',
					'htmlOptions'=>array('style'=>'text-align:center;width:5px'),
				),
				array(
					'type'=>"raw",
					'header'=>'Serial',
					'value'=>'$data->serial=="0"?$data->porDefinir($data->serial):strtoupper($data->serial);',
					'name'=>'serial',
					'htmlOptions'=>array('style'=>'text-align:center;width:65px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Marca',
					'value'=>'$data->idmarcaCaucho==""?$data->porDefinir(""):$data->idmarcaCaucho0->nombre',
					'name'=>'idmarcaCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				
				array(
					'header'=>'Detalle',
					'value'=>'$data->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idcaucho0->idrin0->rin.\' \'.$data->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->iddetalleRueda==null?\' - \':$data->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Posición',
					'value'=>'$data->iddetalleRueda==null?\' - \':$data->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'type'=>"raw",
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
					'header'=>'Estatus',
					'value'=>'$data->coloresEstatus($data)',
					'name'=>'idestatusCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:45px;font-weight: bold;'),
				),
				
					
			),
        ));?>
	<div class="row">
		<?php echo $form->labelEx($model,'idcaucho'); ?>
		<?php echo $form->textField($model,'idcaucho'); ?>
		<?php echo $form->error($model,'idcaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idmarcaCaucho'); ?>
		<?php echo $form->textField($model,'idmarcaCaucho'); ?>
		<?php echo $form->error($model,'idmarcaCaucho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idvehiculo'); ?>
		<?php echo $form->textField($model,'idvehiculo'); ?>
		<?php echo $form->error($model,'idvehiculo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddetalleRueda'); ?>
		<?php echo $form->textField($model,'iddetalleRueda'); ?>
		<?php echo $form->error($model,'iddetalleRueda'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idasigChasis'); ?>
		<?php echo $form->textField($model,'idasigChasis'); ?>
		<?php echo $form->error($model,'idasigChasis'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->