<?php
/* @var $this ViajesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Viajes',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Viajes</strong></div>'),
	array('label'=>'Registrar viajes rutinarios', 'url'=>array('rutinarios')),
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'Histórico de viajes', 'url'=>array('admin')),
	array('label'=>'Estadísticas de viajes', 'url'=>array('admin')),
);
?>
<div class='crugepanel user-assignments-detail'>
<h1>Registro de viajes especiales</h1>
<div id="registro" class='crugepanel user-assignments-detail'>
<?php //$this->renderPartial('_formViajeEspecial', array('model'=>$model)); ?>
</div>
<h1>Listado de viajes registrados</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'viajes',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
			    'enableSorting' => true,
				'emptyText'=>'no hay viajes registrados para ésta fecha',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;'),
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT)',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
				),
				array(
					'header'=>'Fecha',
					'name'=>'fecha',
					'value'=>'date("d/m/Y", strtotime($data->fecha));',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px;'),
				),
				array(
					'header'=>'Ruta realizada',
					'name'=>'idviaje',
					'value'=>'$data->idviaje0->idOrigen0->lugar.\' - \'.$data->idviaje0->idDestino0->lugar',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
				),

				array(
					'header'=>'Salida',
					'name'=>'horaSalida',
					'value'=>'date("g:i a", strtotime($data->horaSalida));',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px;'),
				),
				array(
					'header'=>'Llegada',
					'name'=>'horaLlegada',
					'value'=>'date("g:i a", strtotime($data->horaLlegada));',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px;'),
				),
				array(
					'header'=>'Distancia',
					'value'=>'$data->idviaje0->distanciaKm.\' Km \'',
					//'value'=>'date("g:i a", strtotime($data->horaLlegada));',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
				),
				array(
					'header'=>'Pasajeros',
					'name'=>'nroPersonas',
					//'value'=>'date("g:i a", strtotime($data->horaLlegada));',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px;'),
				),
				array(
					'header'=>'Tipo',
					'value'=>'$data->idviaje0->idtipo0->tipo',
					//'value'=>'date("g:i a", strtotime($data->horaLlegada));',
					'htmlOptions'=>array('style'=>'text-align:center;width:30px;'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:10px;'),
						'htmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'header'=>'Modificar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarViaje("\'.Yii::app()->createUrl("Viajes/update",array("id"=>$data["id"])).\'"); $("#modificar").dialog("open");}\'
                        )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("viajes/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
?>

</div>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'viaje',
    'options'=>array(
        'title'=>'Registrar viaje realizado',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
		'position'=>array(500,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'modificar',
    'options'=>array(
        'title'=>'modificar datos del viaje',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
		'position'=>array(500,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<style>
.badge {
    margin-left: 3px;
}
.crugepanel {
    background-color: #FFF;
    border: 1px dotted #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
}
#menu {
    font-size: 15px;
}
#etiqueta{
	width: auto;
	float: left;
    height: 35px;
}
</style>
<style>
.grid-view table.items th {
	color: rgba(0, 0, 0, 1);
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
}
.grid-view table.items th a {
    color: #000;
    font-weight: bold;
    text-decoration: none;
}
.grid-view table.items td {
    font-size: 0.9em;
    border: 1px solid #5877C3;
    padding: 0.3em;
}
.grid-view table.items th, .grid-view table.items td {
    font-size: 0.9em;
    border: 1px solid #A8C5F0;
    padding: 0.3em;
}
</style>
<script>
if( $('#Historicoviajes_idviaje').empty() ){
	
}
viajeForm();
function viajeForm(){
var dir="<?php echo Yii::app()->baseUrl."/viajes/formAgregarEspecial"?>";
jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#registro').html(data.div);
                                        $('#registro form').submit(viajeForm);
                                }
                                else{
                                        $('#registro').html(data.div);
										window.setTimeout('viajeForm()', 2000);
										$.fn.yiiGridView.update('viajes');
                                }
                        } ,
                'cache':false});
		return false; 
}
</script>
<script>
function agregarViaje(){
$('#viaje').dialog('open');
	var fecha=$('#fecha').val();
	var dir="<?php echo Yii::app()->baseUrl."/viajes/agregarViaje/"?>";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize()+"&fecha="+fecha,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#viaje div.divForForm').html(data.div);
                                        $('#viaje div.divForForm form').submit(agregarViaje); // updatePaymentComment
                                }
                                else{
                                        $('#viaje div.divForForm').html(data.div);
                                        setTimeout("$('#viaje').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('viajes');
										
                                }
                        },
                'cache':false});
    return false; 
}

function editarViaje(id){
$('#modificar').dialog('open');
	 if (typeof(id)=='string')
                Uurl=id;
	jQuery.ajax({
                url: Uurl,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data)
                        {
                                if (data.status == 'failure')
                                {
                                        $('#modificar div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#modificar div.divForForm form').submit(editarViaje); // updatePaymentComment
                                }
                                else
                                {
                                        $('#modificar div.divForForm').html(data.div);
                                        setTimeout("$('#modificar').dialog('close') ",1000);
										$.fn.yiiGridView.update('viajes');
                                }
                        } ,
                'cache':false});
    return false; 
}
</script>