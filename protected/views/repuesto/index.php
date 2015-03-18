<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Repuestos',
);

$this->menu=array(
	array('label'=>'Registrar repuesto', 'url'=>array('repuesto/create')),
	array('label'=>'Asignación de repuestos a grupos', 'url'=>array('repuesto/AsignarPiezaGrupo')),
	array('label'=>'Ver repuestos asignados', 'url'=>array('repuesto/detallePiezaGrupo')),
	array('label'=>'Administrar repuestos', 'url'=>array('admin')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Repuestos y partes</h1>
<div id="filtro" style="width:20%">
<i>Por # de unidad: </i>

		<?php $model=new Vehiculo;	
		echo CHtml::dropDownList('vehiculo',$model,CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),
              array('empty' => 'Todos',
                   'style'=>"width:80px;")); 
        ?>
</div>
<div id="fechas" style="float:left;">
<i>Por repuesto: </i>
		<?php
$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
    'name'=>'ajaxrequest',
	'id'=>'repuesto',
    // additional javascript options for the autocomplete plugin
    'options'=>array(
        'minLength'=>'1',
		
    ),
    'source'=>$this->createUrl("repuesto/buscarRepuesto"),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
		'placeholder'=>"Ejemplo: amortiguador",
    ),
));
?>
		<?php echo CHtml::submitButton('Buscar',array("id"=>"boton","onclick"=>"Filtrar()","style"=>"float:right;margin-top:2px;margin-left:10px;")); ?>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'piezas',
				'summaryText'=>'',
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay repuestos asignados',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'cursor:pointer'),
				'columns'=>array(
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Repuesto',
					'name'=>'idrepuesto',
					'value'=>'\' <b><div style="color:green">\'.$data->idrepuesto0->repuesto.\' </div><b>\'',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:120px'),
				),
				array(
					'header'=>'Categoría',
					'name'=>'idrepuesto',
					'value'=>'$data->idrepuesto0->idsubTipoRepuesto0->subTipo',
					'htmlOptions'=>array('style'=>'text-align:center;width:70px'),
					//'filter' => false,
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
					'header'=>'Cantidad',
					'name'=>'cantidad',
					'value'=>'$data->cantidad',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Detalle',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Ver detalle",array("title"=>"Ver")),		  
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
								\'onclick\'=>\'{mostrarDetalle("\'.$data["id"].\'");}\'
                        )
                );',),
			)
        ));
		?>
</div>
<?php

$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Información actual del repuesto en el vehiculo',
        'autoOpen'=>false,
		'position'=>array(null,100),
        'modal'=>true,
        'width'=>"50%",
        //'height'=>255,
		'resizable'=>false
    ),
));?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'repdetalle',
				'summaryText'=>'',
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay repuestos asignados',
                'dataProvider'=>$det,
				'htmlOptions'=>array('style'=>'cursor:pointer'),
				'columns'=>array(
				array(
					'header'=>'Pieza',
					//'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					'value'=>'$data->idCaracteristicaVeh0->idrepuesto0->repuesto',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				
				array(
					'header'=>'Detalle',
					'name'=>'detallePieza',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				array(
					'header'=>'# Pieza instalada',
					'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				array(
					'header'=>'Fecha instalada',
					'name'=>'codigoPiezaEnUso',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					'value'=>'$data->fechaIncorporacion==null?"-":date("d/m/Y",strtotime($data->fechaIncorporacion))',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				
				/*array(
					'type'=>'raw',
					'header'=>'Repuesto',
					'name'=>'idrepuesto',
					'value'=>'\' <b><div style="color:green">\'.$data->idrepuesto0->repuesto.\' </div><b>\'',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:120px'),
				),
				array(
					'header'=>'Categoría',
					'name'=>'idrepuesto',
					'value'=>'$data->idrepuesto0->idsubTipoRepuesto0->subTipo',
					'htmlOptions'=>array('style'=>'text-align:center;width:70px'),
					//'filter' => false,
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px;'),
					'header'=>'Cantidad',
					'name'=>'cantidad',
					'value'=>'$data->cantidad',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				*/
			)
        ));
		?>
 
<?php $this->endWidget();?>
<style>
.crugepanel {
    background-color: #FFF;
    border: 1px dotted #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
}
</style>
<script>
function Filtrar(){
	$.fn.yiiGridView.update('piezas',{ data : "&repuesto="+$("#repuesto").val()+"&vehiculo="+$("#vehiculo").val()});
}
function mostrarDetalle(id){
	$('#dialog').dialog('open');
	$.fn.yiiGridView.update('repdetalle',{ data : "&id="+id});
	
}
</script>