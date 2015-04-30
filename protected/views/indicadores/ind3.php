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
$this->Widget('ext.highcharts.HighchartsWidget', array(
        'scripts' => array(
        'modules/exporting',
        'themes/grid-light',
    ),

   'options'=>array(
           'chart'=> array(
            
            'defaultSeriesType'=> 'column',
            'zoomType'=> 'xy',
        ),
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
        'title' => array('text' => 'Consumo y gasto total mensual de combustible por unidad'),
        'credits'=> array(
            'enabled'=> false
        ),
        'yAxis'=> array(
        array( // Primary yAxis
            'labels'=> array(
                'format'=> '{value}L',
 
            ),
            'title'=> array(
                'text'=> 'Combustible',
 
            )
        ), array( // Secondary yAxis
            'title'=> array(
                'text'=> 'Costo',
 
            ),
            'labels'=> array(
                'format'=> '{value} Bs.',
 
            ),
            'opposite'=> true
        )),

    'xAxis'=> array(
        array(
            'categories'=> array('01', '02', '03', '04', '05', '06', '07', '08', '09'),
            'tickmarkPlacement'=> 'on',
        ), array(
            'linkedTo'=> 0,
            'categories'=> array('Ene 15', 'Feb 15', 'Mar 15', 'Abr 15', 'May 15', 'Jun 15', 'Jul 15', 'Ago 15', 'Sep 15'),
            //tickPositions: [3, 5, 8],
            'opposite'=> true,
            'labels'=> array(
                    //y:20,
                'style'=> array(
                    //fontWeight: 'bold'
                ),
            ),
        )),

    'series'=> array(
        array(
            'type'=> 'column',
            'data'=> array( 29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4),

        ),
        array(
          'type'=> 'spline',
          'yAxis'=> 1,
            'data'=> array(129.9, 171.5, 1106.4, 1129.2, 1144.0, 1176.0, 1135.6, 1148.5, 216.4),        
        ),),


   ),
));

     /* $this->widget('ext.highcharts.ActiveHighstockWidget', array(
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

      'title' => array('text' => 'Site Percentile'),
      'yAxis' => array(
      'title' => array('text' => 'Site Rank')
      ),
      'series' => array(
      array(
      'name'  => 'Costo',
      'data'  => array(// data column in the dataprovider
        'costoTotal',
      ),        
      'time'  => 'fecha',          // time column in the dataprovider
       'timeType'  => 'date',
      // defaults to a mysql timestamp, other options are 'date' (run through strtotime()) or 'plain'
      ),
 
      /*array(
              'name'  => 'Site percentile',
              'time'  => 'fechaFalla',          // time column in the dataprovider
              'type'  => 'arearange',
              'data'  => array(
              'Column1',      // specify an array of data options
              'Column2',      // if you are using an area range charts
            ),
        ),*/
      /*),
      ),
      'dataProvider' => $dataProvider,
      ));*/
?>
</div>
 

