<?php
/* @var $this NeumaticosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Neumáticos'=>array('index'),
	'Plantillas de montaje',
);

$this->menu=array(
	array('label'=>'      Plantillas de montaje', 'url'=>array('plantilla')),
	array('label'=>'      Montajes-Desmontajes', 'url'=>array('')),
	array('label'=>'      Rotaciones', 'url'=>array('')),
	array('label'=>'      Admin. de parámetros', 'url'=>array('')),
);
?>

<div class='crugepanel user-assignments-role-list'>
<h1>Plantillas de montaje</h1>
<div id="desplegable">
		<?php
		echo CHtml::dropDownList("plantilla","",CHtml::listData(Chasis::model()->findAll(),'id','nombre'),array(
			'prompt'=>"Seleccione: ",'style' => 'width:150px;')); ?>
			
<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'chasis',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>0,
				'emptyText'=>'seleccione una plantilla',
                'dataProvider'=>$chasis,
				'htmlOptions'=>array('style'=>'width:500px;float:right'),
				'columns'=>array(
				array(
					'headerHtmlOptions'=>array('style'=>'width:15%'),
					'header'=>'# Ejes',
					'name'=>'nroEjes',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
				'headerHtmlOptions'=>array('style'=>'width:30%'),
					'header'=>'Neumáticos de Uso',
					'name'=>'cantidadNormales',
					'value'=>'$data->cantidadNormales',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
				'headerHtmlOptions'=>array('style'=>'width:40%'),
					'header'=>'Neumáticos de Repuesto',
					'name'=>'cantidadRepuesto',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
					'headerHtmlOptions'=>array('style'=>'width:50px'),
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
						 
							'delete' => array(
								'url'=>'Yii::app()->createUrl("chasis/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
		?>
		<?php echo CHtml::link('Agregar nueva plantilla', "",array('title'=>'una plantilla valida la cantidad de neumáticos que posee un vehiculo',
        'style'=>'cursor: pointer;font-size:13px;margin-left:0px;',
        'onclick'=>"{
		AgregarRutaNueva(1);}"));?>
</div>
<br>
<div id="llantas">
<div id='activi'><negro>
			Plantilla seleccionada:
			</negro>
			<rojo>
			</rojo>
			</div>
<div id="uno">
<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'ejes',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'seleccione una plantilla',
                'dataProvider'=>$llantas,
				'htmlOptions'=>array('style'=>'cursor:pointer;width:330px;margin-top:10px'),
				'columns'=>array(
				
				array(
					
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px'),
					'header'=>'Eje',
					'name'=>'Eje',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Posición de eje',
					'name'=>'Posición del eje',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
					'header'=>'Ruedas por eje',
					'name'=>'Ruedas por eje',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
			),
        ));
		?>
</div>
<div id="dos">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'cauchos',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'seleccione una plantilla',
                'dataProvider'=>$llantas,
				'htmlOptions'=>array('style'=>'cursor:pointer;width:330px;margin-top:10px;'),
				'columns'=>array(
				
				array(
					
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px'),
					'header'=>'Eje',
					'name'=>'Eje',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Posición de eje',
					'name'=>'Posición del eje',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
					'header'=>'Ruedas por eje',
					'name'=>'Ruedas por eje',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
			),
        ));
		?>
</div>
</div>
</div>
<style>
#uno{
	float:left;
	margin-right:20px;
}
#dos{
	float:left;
	
}
negro{
	color: rgba(0, 0, 0, 1);
}
rojo{
	color: rgba(255, 0, 0, 1);
}
#activi{
	font-weight: bold;
	text-align: left;
	padding: 5px;
	color: rgba(255, 0, 0, 1);
	font-size:120%;
	border: 1px solid #F2B3B3;
	background-color: #EFEFEF;
}
#llantas{
	padding:5px;
	border: 1px solid #A8C5F0;
	float:left;
	
}
#desplegable{
	padding:5px;
	width:655px;
	border: 1px solid #A8C5F0;
	height:60px; 
}
.grid-view {
    padding: 0px 0px;
}
#menu{
	font-size:15px;
}
.grid-view table.items tr.selected {
    background: none repeat scroll 0% 0% rgba(0, 249, 3, 0.3);
}
.crugepanel {
    background-color: #FFF;
    border: 1px dotted #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
	overflow: auto;
}

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
<style>
.ui-progressbar .ui-widget-header {
	background: #FFF;
}
.ui-progressbar {
    border: 0px none;
    border-radius: 0px;
    clear: both;
	margin-bottom: 0px;
}
.progress, .ui-progressbar {
    height: 10px;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br {
    border-bottom-right-radius: 0px;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
    border-bottom-left-radius: 0px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-right, .ui-corner-tr {
    border-top-right-radius: 0px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-left, .ui-corner-tl {
    border-top-left-radius: 0px;
}
</style>
<script>
var va="<?php echo $ca?>";
	$("#plantilla").val(va).change();
$( "#plantilla" ).change(function(){ 
	$.fn.yiiGridView.update('chasis',{ data : "data="+$(this).val()});
});
</script>