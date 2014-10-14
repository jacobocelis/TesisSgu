
<?php
/* @var $this VehiculoController */
/* @var $model Vehiculo */

$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Histórico de reparaciones', 'url'=>array('index')),
	array('label'=>'Piezas y repuestos', 'url'=>array('DetallePieza', 'id'=>$model->id)),
	array('label'=>'Combustible', 'url'=>array('index')),
	array('label'=>'Ruedas', 'url'=>array('index')),
	
	array('label'=>'Fotos', 'url'=>array('/foto/index','id'=>$model->id)),
	
	array('label'=>'Eliminar Vehiculo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Actualizar datos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Regresar', 'url'=>array('index')),
);
?>

<h1>Información completa del vehiculo </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'numeroUnidad',
			array(
			'name'=>'idgrupo',
			'label'=>'Grupo',
			'value'=>$model->idgrupo0->grupo,
			
		),
			array(
			'name'=>'idmodelo',
			'label'=>'Marca',
			'value'=>$model->idmodelo0->idmarca0->marca,
		),
	
		array(
			'name'=>'idmodelo',
			'label'=>'Modelo',
			'value'=>$model->idmodelo0->modelo,
		),
		'anno',
		'placa',
		
			array(
			'name'=>'idtipo',
			'label'=>'Tipo',
			'value'=>$model->idgrupo0->idtipo0->tipo,
			
		),
		array(
			'name'=>'idcombustible',
			'label'=>'Combustible',
			'value'=>$model->idcombustible0->combustible,
		),
			array(
			'name'=>'idcolor',
			'label'=>'Color',
			'value'=>$model->idcolor0->color,
		),
		
		'nroPuestos',
		'nroEjes',
		'capCarga',
		'cantidadRuedas',
		'capTanque',
		'serialCarroceria',
		'serialMotor',
		array(
			'name'=>'idpropiedad',
			'label'=>'Propiedad',
			'value'=>$model->idpropiedad0->propiedad,
		),
		'comentario',
	),
)); 

?>
<br>
<h1>Características adicionales</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'campos',
			'selectableRows'=>0,
			'dataProvider'=>$dataProvider,
			'ajaxUpdate'=>true, 
			'enablePagination' => false,
			'template'=>"{items}{summary}{pager}",
			'emptyText' => 'no hay características adicionales en éste vehiculo',
			'summaryText' => '',
			'columns'=>array(	
				array(
					'header'=>'Característica',
					'name'=>'informacion',
					//'footer'=>'',
					'htmlOptions'=>array('style'=>'text-align:center;width:300px'),
				),
				array(
				'htmlOptions'=>array('style'=>'text-align:center;'),
					'header'=>'Detalle',
					'name'=>'descripcion',
				),
				array(
        'type'=>'raw',
        'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer; width:50px;text-decoration: underline;\',
                                \'onclick\'=>\'{addDetalle("\'.Yii::app()->createUrl("informacion/agregar",array("id"=>$data["id"]))

.\'"); $("#dialog").dialog("open");}\'
                        )
                );',
),
			),
		));?> 
		
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Agregar detalle',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>370,
        'height'=>240,
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
<?php $this->endWidget();?>

<br>
<h1>Fotografías de la unidad </h1>
<br>
<div id="container-1">
	<div class="myGallery">
	    <ul id="myGallery">
			<?php foreach ($model->Fotos as $foto): ?>
				<li><?php echo CHtml::image('data:image/jpeg;base64,'.$foto->imagen); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div id="descriptions">
	</div>
</div>

<script type="text/javascript">
  	$(function(){
		$('#myGallery').galleryView();
	});
	
	var _updatePaymentComment_url;
function addDetalle(_url){
        // If its a string then set the global variable, if its an object then don't set
        if (typeof(_url)=='string')
                _updatePaymentComment_url=_url;

        jQuery.ajax({
                url: _updatePaymentComment_url,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data)
                        {
                                if (data.status == 'failure')
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog div.divForForm form').submit(addDetalle); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('campos');
                                }

                        } ,
                'cache':false});
        return false;

}
</script>
<style>
.row-fluid .span9 {
    width: 53.6%;
}
.grid-view table.items th {
    background: #f8f8f8;
	color:black;
    text-align: center;
}
.grid-view table.items th a:hover {
    color: #000;
    font-weight: bold;
    text-decoration: none;
}
.grid-view table.items th a {
    color: #000;
    font-weight: bold;
    text-decoration: none;
}
</style>