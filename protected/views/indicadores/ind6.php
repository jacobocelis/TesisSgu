<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/highstock.js"); ?>
<?php

$this->breadcrumbs=array(
	'Indicadores y reportes',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Indicadores y reportes</strong></div>' , 'visible'=>'1'),
	 array('label'=>'      Resumen de indicadores', 'url'=>array('Indicadores/ind')),
  array('label'=>'      Tiempo medio entre fallas', 'url'=>array('Indicadores/ind9')),
  array('label'=>'      Tiempo medio para reparaciones', 'url'=>array('Indicadores/ind10')),
  array('label'=>'      Disponibilidad de unidades', 'url'=>array('Indicadores/ind11')),
  array('label'=>'      Costo de mtto por valor de reposición', 'url'=>array('Indicadores/ind5')),
  array('label'=>'      % de incidentes por conductor', 'url'=>array('Indicadores/ind1')),
  array('label'=>'      % de incidentes por unidad', 'url'=>array('Indicadores/ind2')),
  array('label'=>'      Consumo de combustible por unidad', 'url'=>array('Indicadores/ind3')),
  array('label'=>'      Gastos por mtto. preventivo', 'url'=>array('Indicadores/ind7')),
  array('label'=>'      Gastos por mtto. correctivo', 'url'=>array('Indicadores/ind4')),
  array('label'=>'      Total de gastos', 'url'=>array('Indicadores/ind8')),
  //array('label'=>'      Tiempo de servicio', 'url'=>array('Indicadores/ind5')),
  array('label'=>'      Viajes por unidad', 'url'=>array('Indicadores/ind6')),
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
        'title' => array('text' => 'Viajes realizados y estimado de personas transportadas mensualmente por unidad'),
        'credits'=> array(
            'enabled'=> false
        ),
        'yAxis'=> array(
        array( // Primary yAxis
            'min'=>0,
            'labels'=> array(
                'format'=> '{value}',
 
            ),
            'title'=> array(
                'text'=> 'Personas',
 
            )
        ), array( // Secondary yAxis
            'min'=>0,
            'title'=> array(
                'text'=> 'Viajes',
 
            ),
            'labels'=> array(
                'format'=> '{value}',
 
            ),
            'opposite'=> true
        )),

    'xAxis'=> array(
        array(
          
            'title'=>array(
                'text'=>'# Unidad',
              ),
            'categories'=> $unidad,
            'tickmarkPlacement'=> 'on',
             'min'=> $filas, 
        ), array(
            'linkedTo'=> 0,
            'categories'=> $fecha,
            //tickPositions: [3, 5, 8],
            'opposite'=> true,
            'labels'=> array(
                    //y:20,
                'style'=> array(
                    //fontWeight: 'bold'
                ),
            ),
        )),

    'scrollbar'=> array(
        'enabled'=> true,
    ),

    'series'=> array(
        array(
             
            'data'=> array_map('intVal', $personas),
            'name'=>'Personas',
            'color'=>'#058DC7',
        ),
        array(
          'type'=>'spline',
          'yAxis'=> 1,
          'name'=>'Viajes',
          'color'=> '#50B432',
          'data'=> array_map('intVal', $total),
        ),),


   ),
));


//select  from sgu_historicocombustible group by idvehiculo,month(fecha)
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
 

