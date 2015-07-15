<?php
/* @var $this RepuestoController */
/* @var $model Repuesto */

$this->breadcrumbs=array(
	'Repuestos'=>array('index'),
	'Registrar',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Repuestos</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Repuestos y partes', 'url'=>array('repuesto/index')),
	array('label'=>'      Registrar repuesto', 'url'=>array('repuesto/create')),
	array('label'=>'      Asignación de repuestos', 'url'=>array('repuesto/AsignarPiezaGrupo')),
	array('label'=>'      Registrar repuestos iniciales <span class="badge badge- pull-right">0</span>', 'url'=>array('repuesto/iniciales/')),
	
	array('label'=>'<div id="menu"><strong>Histórial</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Histórico de repuestos', 'url'=>array('repuesto/historico')),

	array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>Yii::app()->user->checkAccess('action_repuesto_parametros') or Yii::app()->user->checkAccess('action_empleados_coordinadores') or Yii::app()->user->checkAccess('action_empleados_proveedores')),
	array('label'=>'      Parámetros y datos maestros', 'url'=>array('repuesto/parametros'), 'visible'=>Yii::app()->user->checkAccess('action_repuesto_parametros')),
	array('label'=>'      Coordinadores', 'url'=>array('empleados/coordinadores'), 'visible'=>Yii::app()->user->checkAccess('action_empleados_coordinadores')),
	array('label'=>'      Proveedores', 'url'=>array('empleados/proveedores'), 'visible'=>Yii::app()->user->checkAccess('action_empleados_proveedores')),);
?>
<div class='crugepanel'>
<h1>Registrar repuesto</h1>
	

<div id="rep" ></div>

</div>
<div class='crugepanel'>
<h1>Repuesto registrados</h1>
	
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'repuestos',
				//'summaryText'=>'no hay repuestos registrados',
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'No hay repuestos registrados',
                'dataProvider'=>$repuestos,
				'htmlOptions'=>array('style'=>''),
				'columns'=>array(
				array(
					'header'=>'Repuesto',
					'name'=>'repuesto',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idCaracteristicaVeh0->idrepuesto0->repuesto',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				array(
					'header'=>'Tipo',
					//'name'=>'idsubTipoRepuesto',
					//'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					'value'=>'$data->idsubTipoRepuesto0->idTipoRepuesto0->tipo',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
				array(
					'header'=>'Subtipo',
					'name'=>'idsubTipoRepuesto',
					'value'=>'$data->idsubTipoRepuesto0->subTipo',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:20px'),
				),
			)
        ));
		?>

</div>
<script>
agregarRepuesto();
function agregarRepuesto(){
	var dir="<?php echo Yii::app()->baseUrl."/repuesto/agregar/"?>";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#rep').html(data.div);
                                        $('#rep form').submit(agregarRepuesto);
                                }
                                else{
                                        //$('#viaje').html(data.div);
										//$('#viaje').css('background','#9EF79C');
                                        //setTimeout("$('#viaje').dialog('close') ",1000);
                                         //agregarViajeRutinario();
                                         //$('body').scrollTo('#resultado',{duration:'slow', offsetTop : '0'});
                                         //$('#resultado').html(data.mensaje);
										 $.fn.yiiGridView.update('repuestos');
										 agregarRepuesto();

                                }
                        },
                'cache':false});
    return false; 
}
function Subtipo(id){
	
var dir="<?php echo Yii::app()->baseUrl;?>"+"/repuesto/Selectdos/"+id;
	$.ajax({  		
          url: dir,
		  //'type'=>'POST',
		  'success':function(data){

			$('#Repuesto_idsubTipoRepuesto').html(data);
			//$('#Historicoviajes_idconductor').html(result.lista);		  
		  }
        })
  	.done(function( result ) {
	
    	     $('#Repuesto_idsubTipoRepuesto').val(result.puestos);
			 //$('#Historicoviajes_idconductor').html(result.lista);
  	});
}
</script>