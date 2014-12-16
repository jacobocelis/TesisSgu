<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Partes y piezas',
);

$this->menu=array(
	array('label'=>'Registrar pieza', 'url'=>array('create')),
	array('label'=>'Asignación de piezas a grupos', 'url'=>array('asignarPiezaGrupo/AsignarPieza')),
	array('label'=>'Ver piezas asignadas en grupos', 'url'=>array('detallePiezaGrupo/detallePieza')),
	array('label'=>'Administrar piezas', 'url'=>array('admin')),
);
?>

<?php 
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
		'chart'=>array(
			'type'=>'column'
		),
		'title' => array(
			'text' => 'Total de repuestos reemplazados por mantenimiento en lo que va de año 2014',
			'style'=>array('fontSize'=>'22px'),
		),
		'xAxis' => array(
			'categories' => array('04', '23', '17','44','16','12','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'),
			'title'=>array('text'=>'Unidades'),
		),
		'yAxis' => array(
			'title' => array('text' => 'Repuestos')
		),
		'series' => array(
			array('name' => 'Preventivo', 'data' => array(36, 32, 33,40)),
			array('name' => 'Correctivo', 'data' => array(12, 25, 5,16))
      ),
	    'tooltip'=>array(
            'headerFormat'=>'<span style="font-size:10px">{point.key}</span><table>',
            'pointFormat'=>'<tr><td style="color:{series.color};padding:0">{series.name}: </td><td style="padding:0"><b>{point.y:.f} repuestos.</b></td></tr>',
            'footerFormat'=> '</table>',
            'shared'=> true,
            'useHTML'=> true,
        ),
   )
));
?>
