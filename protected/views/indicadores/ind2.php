<?php

$this->breadcrumbs=array(
	'Indicadores y reportes',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Indicadores y reportes</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Tiempo medio entre fallas', 'url'=>array('Indicadores/ind9')),
  array('label'=>'      Tiempo medio para reparaciones', 'url'=>array('Indicadores/ind10')),
    array('label'=>'      Disponibilidad de unidades', 'url'=>array('Indicadores/ind11')),
  array('label'=>'      Costo de mtto por valor de reposición', 'url'=>array('Indicadores/ind5')),
    array('label'=>'      % de incidentes por conductor', 'url'=>array('Indicadores/ind1')),
    array('label'=>'      % de incidentes por unidad', 'url'=>array('Indicadores/ind2')),
    array('label'=>'      Consumo de combustible por unidad', 'url'=>array('Indicadores/ind3')),
    array('label'=>'      Gastos por mtto. preventivo', 'url'=>array('Indicadores/ind7')),
    array('label'=>'      Gastos por mtto. correctivo', 'url'=>array('Indicadores/ind4')),
    array('label'=>'      Gastos por neumáticos', 'url'=>array('Indicadores/ind8')),
    //array('label'=>'      Tiempo de servicio', 'url'=>array('Indicadores/ind5')),
    array('label'=>'      Viajes por unidad', 'url'=>array('Indicadores/ind6')),
);
?>
<div class="crugepanel">
<?php
$this->widget('ext.highcharts.HighchartsWidget', array(

    'scripts' => array(
        'modules/exporting',
        'themes/grid-light',
    ),
    'options' => array(
                'lang'=>array(  
                'loading'=> 'Cargando...',  
                'months'=> array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'),  
                'weekdays'=> array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'),  
                'shortMonths'=> array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'),  
                'exportButtonTitle'=> "Exportar",  
                'printButtonTitle'=> "Importar",  
                'rangeSelectorFrom'=> "De",  
                'rangeSelectorTo'=> "A",  
                'rangeSelectorZoom'=> "Periodo",  
                'downloadPNG'=> 'Descargar gráfica PNG',  
                'downloadJPEG'=> 'Descargar gráfica JPEG',  
                'downloadPDF'=> 'Descargar gráfica PDF',  
                'downloadSVG'=> 'Descargar gráfica SVG',  
                'printChart'=> 'Imprimir Gráfica',  
                'thousandsSep'=> ",",  
                'decimalPoint'=> '.'  
            ),

        'credits'=> array(
            'enabled'=> false
        ),
    	'chart'=>array(
			'type'=>'pie',
			 'options3d'=>array(
                'enabled'=> true,
                'alpha'=> 45,
                'beta'=> 0
			),
		),
        'title' => array(
            'text' => 'Porcentaje de incidentes por unidad',
            'style'=>array('fontSize'=>'24px'),
        ),
 		'tooltip'=> array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>'
        ),
 		'plotOptions'=> array(
            'pie'=> array(
                'allowPointSelect'=> true,
                'cursor'=> 'pointer',
                'depth'=> 35,
                'dataLabels'=> array(
                    'enabled'=> true,
                    'format'=> '<b>{point.name}</b> <br>{point.percentage:.1f} %',
                ),
                'showInLegend'=> true,
            ),
        ),
		   'series' => array (
		        array (
		          'type' => 'pie',
		          'name' => 'Incidentes',
		          'data' => $ind,
		    ),
		),
    )
));
?>
</div>
 

