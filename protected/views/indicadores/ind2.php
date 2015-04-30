<?php

$this->breadcrumbs=array(
	'Indicadores y reportes',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Indicadores</strong></div>' , 'visible'=>'1'),
	array('label'=>'      % de incidentes por conductor', 'url'=>array('Indicadores/ind1')),
    array('label'=>'      % de incidentes por unidad', 'url'=>array('Indicadores/ind2')),
    array('label'=>'      Consumo de combustible por unidad', 'url'=>array('Indicadores/ind3')),
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
 

