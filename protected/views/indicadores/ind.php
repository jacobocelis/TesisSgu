<script src="http://code.highcharts.com/highcharts-more.js"></script>
<script src="http://code.highcharts.com/modules/solid-gauge.js"></script>

<?php

$this->breadcrumbs=array(
	'Indicadores y reportes',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Indicadores y reportes</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Resumen de indicadores', 'url'=>array('Indicadores/ind')),
  array('label'=>'      Tiempo medio entre fallas', 'url'=>array('Indicadores/ind9')),
  array('label'=>'      Tiempo medio para reparaciones', 'url'=>array('Indicadores/ind10')),
  array('label'=>'      Disponibilidad por unidad', 'url'=>array('Indicadores/ind11')),
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

<div style="float:left;width:100%">
<h1 style="width:60%;">Resumen de indicadores</h1><br>
 <?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'form',
    'enableAjaxValidation'=>false,
    //'htmlOptions' => array('style' => 'width:360px;')
)); ?>

<div id="fechas" style="float:left;">
<i>Desde: </i>
    <?php echo CHtml::textField('Fechaini', $desde,array('style'=>'width:80px;cursor:pointer;','size'=>"10","readonly"=>'readonly','placeholder'=>"Inicio",'id'=>'inicio')); ?>
    <i>Hasta: </i>
    <?php echo CHtml::textField('Fechafin', $hasta,array('style'=>'width:80px;cursor:pointer;',"readonly"=>'readonly','id'=>'fin','placeholder'=>"Fin")); 
    echo CHtml::submitButton('Calcular',array("id"=>"boton","name"=>"but","style"=>"float:right;margin-top:2px;margin-left:10px;"));?>

</div>

<?php $this->endWidget(); ?>

</div>

<div style="margin:  0px auto 0px;max-width: 900px;">
  
<div id="tmpf" style="width: 300px; height: 200px; float: left"></div>
<div id="tmpr" style="width: 300px; height: 200px; float: left"></div>
<div id="disp" style="width: 300px; height: 200px; float: left"></div>

</div>
<div style="margin-top:60px;display:none">
<?php $this->Widget('ext.highcharts.HighchartsWidget', array(
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
        'title' => array('text' => 'Disponibilidad por vehiculo'),
        'credits'=> array(
            'enabled'=> false
        ),
        'tooltip'=> array(
            'pointFormat'=> '<b> {point.y:.1f} %</b>'
        ),
        'yAxis'=> array(
           //'endOnTick'=>false,
           //'tickInterval'=>1,
        array( // Primary yAxis
          //'min'=>1,
           'allowDecimals'=> false,
            'min'=>0,
            'max'=>100,
            'labels'=> array(
                'format'=> '{value}%',
            ),
            'title'=> array(
                'text'=> '%',
            )
        )),

    'xAxis'=> array(
        array(
            'title'=>array(
                'text'=>'Mes-año',
              ),
            'categories'=> $vehiculos,
            'tickmarkPlacement'=> 'on',
             //'min'=> $filas, 
        ), /*array(
            'linkedTo'=> 0,
            'categories'=> $mes,
            //tickPositions: [3, 5, 8],
            'opposite'=> true,
            'labels'=> array(
                    //y:20,
                'style'=> array(
                    //fontWeight: 'bold'
                ),
            ),
        )*/),

    'scrollbar'=> array(
        'enabled'=> false,
    ),
    'series'=> array(
        array(
            'type'=> 'column',
            'data'=> array_map('IntVal', $dispPeriodo),
            'name'=>'días',

        )),
   ),
));
?>
</div>
</div>
 <?php

$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'nuevo',
    'options'=>array(
        'title'=>'indique el valor de meta de disponibilidad',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>360,
    
        //'height'=>480,
    'resizable'=>false, 
    'position'=>array(null,130),
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<script type="text/javascript">
$(function($){
      $.datepicker.regional['es'] = {
          closeText: 'Cerrar',
          prevText: 'Anterior',
          nextText: 'Siguiente',
          currentText: 'Hoy',
          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
          dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
          dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
          dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
          weekHeader: 'Sm',
          dateFormat: 'dd/mm/yy',
          firstDay: 1,
          isRTL: false,
      changeMonth: true,
            changeYear: true,
          showMonthAfterYear: false,
          yearSuffix: '',
          maxDate: '0d',
          //minDate: '-30d',
      };
      $.datepicker.setDefaults($.datepicker.regional['es']);
    });  
    
    $("#inicio").datepicker({
      onSelect: function(selected) {
        $("#fin").datepicker("option","minDate", selected+" +1d");
        if($("#inicio").val().length==0)
          
          $('#fin').attr("disabled", true);
        else
          $('#fin').attr("disabled", false);
      }
    });
    $("#fin").datepicker({
      onSelect: function(selected) {
        
      }
    });
    
function FiltrarFecha(){
  var hoy="<?php echo date("d/m/Y")?>";
  if($("#fin").val().length==0 && $("#inicio").val().length>0)
    $("#fin").val(hoy);

  //$.fn.yiiGridView.update('gastos',{ data : "fechaIni="+$("#inicio").val()+"&fechaFin="+$("#fin").val()+"&vehiculo="+$("#vehiculo").val()});
}

$(function () {

    var disp = {

        exporting:{
          enabled:false
        },
        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '85%'],
            size: '140%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false,
            valueDecimals: 1
        },

        // the value axis
        yAxis: {
            stops: [
                [0.6, '#DF5353'], 
                
                [0.7, '#FC7D00'],
                [0.99, '#DDDF0D'],
                [1, '#55BF3B'] 
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
            title: {
                y: -70
            },
            labels: {
                y: 16
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };
var tmef = {

        exporting:{
          enabled:false
        },
        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '85%'],
            size: '140%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false,
            valueDecimals: 1
        },

        // the value axis
        yAxis: {
            stops: [
                [0.6, '#DF5353'], 
                
                [0.7, '#FC7D00'],
                [0.99, '#DDDF0D'],
                [1, '#55BF3B'] 
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
            title: {
                y: -70
            },
            labels: {
                y: 16
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };
    var tmpr = {

        exporting:{
          enabled:false
        },
        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '85%'],
            size: '140%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false,
            valueDecimals: 1
        },

        // the value axis
        yAxis: {
            stops: [
                [0.6, '#55BF3B'], 
                
                [0.7, '#DDDF0D'],
                [0.99, '#FC7D00'],
                [1, '#DF5353'] 
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
            title: {
                y: -70
            },
            labels: {
                y: 16
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };
    // The speed gauge
    $('#tmpf').highcharts(Highcharts.merge(tmef, {

        yAxis: {
            min: 0,
            max: <?php echo round($meta_falla,1);?>,
            title: {
                text: 'Tiempo medio entre fallas'
            },
            labels:
            {
              enabled: false
            }
        },

        credits: {
            enabled: false
        },

        series: [{
            name: ' días',
            data: [<?php echo round($TMEF_total,1);?>],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'blue') + '">{y} días</span><br/>' +
                       '<span style="font-size:12px;color:gray">Meta: <?php echo round($meta_falla,1);?></span></div>'
            }
        }]

    }));
    $('#tmpr').highcharts(Highcharts.merge(tmpr, {

        yAxis: {
            min: 0,
            max: <?php echo round($meta_rep,1);?>,
            title: {
                text: 'Tiempo medio para reparación'
            },
            labels:
            {
              enabled: false
            }
        },

        credits: {
            enabled: false
        },

        series: [{
            name: '%',
            data: [<?php echo round($TMPR_total,1);?>],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'blue') + '">{y} días</span><br/>' +
                       '<span style="font-size:12px;color:gray">Meta: <?php echo round($meta_rep,1);?></span></div>'
            }
        }]

    }));
    $('#disp').highcharts(Highcharts.merge(disp, {

        yAxis: {
            min: 0,
            max: <?php echo round($meta,1);?>,
            title: {
                text: 'Disponibilidad'
            },
            labels:
            {
              enabled: false
            }
        },

        credits: {
            enabled: false
        },

        series: [{
            name: '%',
            data: [<?php echo round($DISP_total,1);?>],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'blue') + '">{y}%</span><br/>' +
                       '<span style="font-size:12px;color:gray">Meta: <?php echo round($meta,1);?>%</span></div>'
            }
        }]

    }));
});

</script>


