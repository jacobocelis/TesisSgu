<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'neumáticos'=>array('neumaticos/index'),
	'Histórico de montajes',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	
	array('label'=>'      Histórico de mantenimientos', 'url'=>array('historicoCorrectivo')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Histórico de rotaciones</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'rotaciones',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>2,
				'emptyText'=>'No hay neumáticos agregados para renovar',
                'dataProvider'=>$rotaciones,
				'htmlOptions'=>array('style'=>'cursor:pointer;'),
				'columns'=>array(
				array(
					'type'=>'raw',
					'header'=>'Fecha',
					'name'=>'fechaRealizada',
					'value'=>'date("d/m/Y",strtotime($data->fechaRealizada))',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Nombre',
					'name'=>'nombre',
					'htmlOptions'=>array('style'=>'text-align:center;width:85px'),
				),
				array(
					'header'=>'Descripción',
					'name'=>'descripcion',
					'htmlOptions'=>array('style'=>'text-align:center;width:200px'),
				),
				array(
					'header'=>'Costo',
					'name'=>'costoTotal',
					'value'=>'number_format($data->costoTotal, 2,",",".").\' Bs.\'',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:12px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Movimientos',
						'type'=>'raw',
						'value'=>'($data->id==0?\'-\':\' \').CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/ver.png",
                                          "Agregar",array("title"=>"Agregar movimiento de neumáticos")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{mostrarMovimientos("\'.$data["id"].\'");}\'
                        )
                );',),
				array(
					'header'=>'Estado',
					'name'=>'idestatus',
					'type'=>'raw',
					'value'=>'$data->color($data->idestatus,$data->idestatus0->estatus)',
					'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
				),


			)
        ));
?>
</div>
<style>
.grid-view table.items th {
	color: #000;
}
#menu{
	font-size:15px;

}
.crugepanel {
    background-color: #FFF;
    border: 1px dotted #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
	overflow:auto;
}

.rojo{
background: none repeat scroll 0% 0% #CDFBCC;
}
.ui-progressbar .ui-widget-header {
	background: #FFF;
}
.ui-widget-header {
    border: 1px solid #AAA;
    background-image: url("<?php echo Yii::app()->request->baseUrl;?>/imagenes/imagen.png");
    color: #222;
    font-weight: bold;
}
.ui-progressbar {
    border: 0px none;
    border-radius: 0px;
    clear: both;
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
<style>
.grid-view table.items th {
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
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
