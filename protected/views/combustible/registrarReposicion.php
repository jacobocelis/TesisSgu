<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Combustible'=>array('index'),
	'Registrar reposición',
);

$this->menu=array(
	array('label'=>'List Historicocombustible', 'url'=>array('index')),
	array('label'=>'Manage Historicocombustible', 'url'=>array('admin')),
);
?>
<div class='crugepanel user-assignments-detail'>

<div id="reposicion"></div>
</div>
<div class='crugepanel user-assignments-detail'>
<h1>Últimas reposiciones registradas</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'comb',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
				'emptyText'=>'no se han registrado reposiciones',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;'),
				'columns'=>array(
				
				
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'header'=>'Litros',
					'name'=>'litros',
					//'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:25px'),
				),
				array(
					'header'=>'Conductor',
					'name'=>'idempleado',
					'value'=>'$data->idconductor0->nombre.\' \'.$data->idconductor0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'header'=>'Estación',
					'name'=>'idestacionServicio',
					'value'=>'$data->idestacionServicio0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Última reposición',
					'name'=>'fecha',
					'value'=>'$data->fechaReposicion($data->fecha)',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
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
#reposicion{
	width:580px;
}
</style>

<script>
registrarReposicion();
function registrarReposicion(){
	var dir="<?php echo Yii::app()->baseUrl."/combustible/regReposicion/"?>";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#reposicion').html(data.div);
                                        $('#reposicion form').submit(registrarReposicion);
										//$('#reposicion').css('background','#E7FAFA');
                                }
                                else{
                                        $('#reposicion').html(data.div);
										$('#reposicion').css('background','#9EF79C');
                                        //setTimeout("$('#viaje').dialog('close') ",1000);
                                        window.setTimeout('registrarReposicion()', 2000);
										$.fn.yiiGridView.update('comb');
                                }
                        },
                'cache':false});
    return false; 
}
</script>