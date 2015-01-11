<?php
/* @var $this NeumaticosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Neumáticos',
);

$this->menu=array(
	array('label'=>'      Plantillas de montaje', 'url'=>array('plantilla')),
	array('label'=>'      Montajes-Desmontajes', 'url'=>array('')),
	array('label'=>'      Rotaciones', 'url'=>array('')),
	array('label'=>'      Admin. de parámetros', 'url'=>array('')),
);
?>
<div class='crugepanel user-assignments-detail'>
<h1>Neumáticos actualmente en uso por vehiculo</h1>
<div id="sep">

 <?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'form',
    'enableAjaxValidation'=>false,
)); ?>
		Filtrar por #:  
		<?php $model=new Vehiculo;
		echo CHtml::submitButton('Buscar',array("id"=>"boton","style"=>"float:right;margin-top:2px;margin-left:10px;")); 
		echo $form->dropDownList($model,'id',CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),array('prompt'=>'Todos ','style' => 'width:100px;float:right')); ?>
		
<?php $this->endWidget(); ?>
</div>
<?php  $i=0; foreach($montados as $mont){?>

<div class="cuadro">
<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$veh[$i],
	'emptyText'=>'No hay registros',
	'summaryText'=>'',
	'itemView'=>'vehiculos',
));
$this->widget('zii.widgets.grid.CGridView', array(
				//'id'=>'montados',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay registros',
                'dataProvider'=>$mont,
				'htmlOptions'=>array('style'=>'margin-top:10px;width:100%'),
				'columns'=>array(
				array(
					'header'=>'Fecha de montaje',
					'value'=>'$data->fecha',
					'name'=>'fecha',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Serial',
					//'value'=>'$data->idgrupo0->grupo',
					'name'=>'serial',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Marca',
					//'value'=>'$data->idgrupo0->grupo',
					'name'=>'idmarcaCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Eje',
					'value'=>'$data->iddetalleRueda0->iddetalleEje0->idposicionEje0->posicionEje',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Posición',
					'value'=>'$data->iddetalleRueda0->idposicionRueda0->posicionRueda',
					'name'=>'iddetalleRueda',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Detalle',
					'value'=>'$data->idcaucho0->idmedidaCaucho0->medida.\' R\'.$data->idcaucho0->idrin0->rin.\' \'.$data->idcaucho0->idpiso0->piso',
					'name'=>'idcaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Estatus',
					'value'=>'$data->idestatusCaucho0->estatusCaucho',
					'name'=>'idestatusCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px;color: #42C66E;font-weight: bold;'),
				),
					
			),
        ));
$this->widget('zii.widgets.grid.CGridView', array(
                //'id'=>'rep',
				'summaryText'=>'',
			   // 'enableSorting' => false,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay registros',
                'dataProvider'=>$rep[$i],
				'htmlOptions'=>array('style'=>'margin-top:10px;width:100%'),
				'columns'=>array(
				array(
					'header'=>'Fecha de incorporado',
					'value'=>'$data->fecha',
					'name'=>'fecha',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Serial',
					//'value'=>'$data->idgrupo0->grupo',
					'name'=>'serial',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Marca',
					//'value'=>'$data->idgrupo0->grupo',
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
					'header'=>'Estatus',
					'value'=>'$data->idestatusCaucho0->estatusCaucho',
					'name'=>'idestatusCaucho',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px;color:#0078FF;font-weight: bold;'),
				),
			),
        ));
		$i++;
	?>
</div>		
<?php
}
?>
</div>
<script>
$('#form').submit(function() {
        $('#boton').val("Buscando...");
		$('#boton').attr("disabled", true);
        return true; // return false to cancel form action
    });
$( document ).ready(function() {
		$('#boton').val("Buscar");
		$('#boton').attr("disabled", false);
});
</script>
<style>
form {
    margin: 0px 0px 0px;
}
#sep{
	margin-bottom: 20px;
	text-align: right;
	font-size: 120%;
}
.cuadro {
    background: none repeat scroll 0% 0% #F9FDFD;
    padding: 5px;
    border: 1px solid #94A8FF;
    margin-top: 5px;

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