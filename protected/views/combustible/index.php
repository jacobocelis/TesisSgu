<?php
/* @var $this CombustibleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Combustible',
);

$this->menu=array(
	array('label'=>'      Registrar reposición', 'url'=>array('create')),
	array('label'=>'      Autonomía de combustible', 'url'=>array('autonomia')),
	array('label'=>'      Histórico de reposición', 'url'=>array('admin')),
	array('label'=>'      Estadísticas', 'url'=>array('admin')),
);
?>
<h1>Última reposición de combustible</h1>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'combustible',
				'summaryText'=>'',
			    //'rowCssClassExpression'=>'$this->dataProvider->data[$row]->ReposicionDias($data->fecha)>='.$reposicionDias.'?"rojo":"even"',
				'emptyText'=>'No hay registro de reposiciónes',
                'dataProvider'=>$dataProvider,
				//'Nombre:text:Nombre',
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
			)
        ));
?>
<i>Mostrar alerta cuando un vehiculo no tenga reposición transcurridos 
<select id="lista" >
		<?php for($i=1;$i<11;$i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
			?>
		</select> o más días en adelante</i>
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
<style>
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
