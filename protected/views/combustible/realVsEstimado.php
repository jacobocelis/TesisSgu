<?php
/* @var $this CombustibleController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(

	array('label'=>'<div id="menu"><strong>Combustible</strong></div>'),
	array('label'=>'      Registrar reposición', 'url'=>array('registrarReposicion')),
	array('label'=>'      Autonomía de combustible', 'url'=>array('autonomia')),
	array('label'=>'      Histórico de reposición', 'url'=>array('historicoReposicion')),
	
	array('label'=>'      Administración de parámetros', 'url'=>array('admin')),
	
	array('label'=>'<div id="menu"><strong>Estadísticas</strong></div>'),
	array('label'=>'      Consumo real vs estimado ', 'url'=>array('realVsEstimado')),
);
?>

<div class='crugepanel user-assignments-role-list'>
<h1>Consumo real vs. consumo estimado</h1>
<?php 
			
			
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
		'chart'=>array(
			'type'=>'column'
		),
		'title' => array(
			'text' => 'La gráfica muestra el consumo real junto al consumo estimado en litros de combustible en base a los km recorridos en la ultima reposición realizada'
		),
		'xAxis' => array(
			'categories' => array('01', '02', '03','04','05','06','07','08','09','10','11','12'),
			'title'=>array('text'=>'Unidades'),
		),
		'yAxis' => array(
			'title' => array('text' => 'litros(l.)')
		),
		'series' => array(
			array('name' => 'Real', 'data' => array(57, 74, 25,11)),
			array('name' => 'Estimado', 'data' => array(14, 90, 89,73))
      ),
	    'tooltip'=>array(
            'headerFormat'=>'<span style="font-size:10px">{point.key}</span><table>',
            'pointFormat'=>'<tr><td style="color:{series.color};padding:0">{series.name}: </td><td style="padding:0"><b>{point.y:.0f} Km/l.</b></td></tr>',
            'footerFormat'=> '</table>',
            'shared'=> true,
            'useHTML'=> true,
        ),
   )
));
	?>
	</div>
<style>
.grid-view table.items th {
    color: #000;
    background: url('bg.gif') repeat-x scroll left top #FFF;
    text-align: center;
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
