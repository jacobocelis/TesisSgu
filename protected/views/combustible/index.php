<?php
/* @var $this CombustibleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Combustible',
);
$this->menu=array(

	array('label'=>'<div id="menu"><strong>Combustible</strong></div>'),
	array('label'=>'      Reposiciónes', 'url'=>array('combustible/index')),
	array('label'=>'      Registrar reposición', 'url'=>array('registrarReposicion')),
	
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de reposiciónes', 'url'=>array('combustible/historicoReposicion')),
	array('label'=>'      Histórico de gastos', 'url'=>array('combustible/historicoGastos')),
	array('label'=>'<div id="menu"><strong>Parámetros</strong></div>'),
	array('label'=>'      Administración de parámetros', 'url'=>array('combustible/parametros')),
	
);
?>

<div class='crugepanel user-assignments-detail'>
<h1>Reposiciones de combustible</h1>
<i style="float:left">* Muestra la ultima reposición de combustible realizada por vehiculo</i>
<i style="float:right">Mostrar alerta cuando un vehiculo no tenga reposición a partir de 
<select id="lista" >
		<?php for($i=1;$i<11;$i++)
			
			if($i==10)
				echo '<option value="'.$i.'">10+</option>';
			else
				echo '<option value="'.$i.'">'.$i.'</option>';	
			?>
		</select> días.</i>
<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'combustible',
				'summaryText'=>'',
			    'rowCssClassExpression'=>'$this->dataProvider->data[$row]->ReposicionDias($data->fecha)>='.$reposicionDias.'?"rojo":"even"',
				'emptyText'=>'No hay registro de reposiciónes',
                'dataProvider'=>$dataProvider,	
				'columns'=>array(
				
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					//'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'Placa',
					'name'=>'idplan',
					'value'=>'$data->idvehiculo0->placa',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
					//'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'Marca',
					'name'=>'idplan',
					'value'=>'$data->idvehiculo0->idmodelo0->idmarca0->marca',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					//'headerHtmlOptions'=>array('style'=>'width:7%'),
					'header'=>'Modelo',
					'name'=>'idplan',
					'value'=>'$data->idvehiculo0->idmodelo0->modelo',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
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
					'header'=>'Fecha y hora',
					'name'=>'fecha',
					'value'=>'date("d/m/Y h:i A",strtotime($data->fecha))',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
					array(
					'header'=>'Litros',
					'name'=>'litros',
					//'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:25px;color:green;font-weight: bold;'),
				),
				array(
					'type'=>'raw',
					'header'=>'Última reposición',
					'name'=>'fecha',
					'value'=>'$data->fechaReposicion($data->fecha)',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				
			)
        ));
//'Nombre:text:Nombre',?>


</div>
<style>
#menu {
    font-size: 15px;
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
.rojo{
background: none repeat scroll 0% 0% #FFD6D6;
}
#lista{
	width:50px;
}
#verde{
	color: #0FA526;
	font-weight: bold;
}
.grid-view table.items th {
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
	color: #000;
}
.grid-view table.items th a {
    color: #000!important;
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
var valor="<?php echo $reposicionDias?>";
$("#lista").val(valor).change();
//$("#lista option:selected").val();
$("#lista").change(function(){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/combustible/alertaReposicion/"+$(this).val();
$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
			$.fn.yiiGridView.update('combustible');
  	});
});
</script>

