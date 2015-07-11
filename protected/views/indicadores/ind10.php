<script src="http://code.highcharts.com/highcharts-more.js"></script>
<script src="http://code.highcharts.com/modules/solid-gauge.js"></script>

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
  array('label'=>'      Total de gastos', 'url'=>array('Indicadores/ind8')),
    //array('label'=>'      Tiempo de servicio', 'url'=>array('Indicadores/ind5')),
  array('label'=>'      Viajes por unidad', 'url'=>array('Indicadores/ind6')),
);
?>
<div class="crugepanel">
  <div style=" margin: 0 auto;float:right">
  
<div id="container-speed" style="width: 180px; height: 130px; float: left"></div>
<div style=""><i>      Establecer una meta</i>
    <?php echo CHtml::link('<img src='.Yii::app()->baseUrl.'/imagenes/agregar.png alt="algo"/>',"",array('title'=>'Registrar un nuevo grupo de vehiculos',
        'id'=>'link',
        'style'=>'cursor: pointer;',
        'onclick'=>"{
    nuevo('/metas/establecer/1','tmpr'); $('#nuevo').dialog('open');}"));?>
</div>
</div>

<h1 style="width:60%;">Tiempo Medio Para Reparación</h1><br>
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

<div style="margin-top:60px;">

<?php $this->Widget('ext.highcharts.HighchartsWidget', array(
        'scripts' => array(
        //'modules/exporting',
        'themes/grid-light',
    ),

   'options'=>array(
           'chart'=> array(
 
            'defaultSeriesType'=> 'column',
            //'zoomType'=> 'xyz',
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
        'title' => array('text' => 'Por grupos'),
        
        'credits'=> array(
            'enabled'=> false
        ),
        'yAxis'=> array(
           //'endOnTick'=>false,
           //'tickInterval'=>1,
        array( // Primary yAxis
          'min'=>0,
          //'max'=>31,
            'labels'=> array(
                'format'=> '{value}días',            
            ),
            'title'=> array(
                'text'=> 'Días',
            ),

        )),
    /*'tooltip'=> array(
        'pointFormat'=> "Value: <b>{point.y:.1f} días</b>",
    ),*/
    'xAxis'=> array(
        array(
          
            'title'=>array(
                'text'=>'Grupo de vehiculos',
              ),
            'categories'=> $grupos,
            'tickmarkPlacement'=> 'on',
             //'min'=> $filas, 
        )),


    'series'=> array(
        array(
            'type'=> 'column',
            'data'=> array_map('floatVal', $TMPR),
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
        'title'=>'indique el valor de meta de TMEF',
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

    var gaugeOptions = {

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
            enabled: false
        },

        // the value axis
        yAxis: {
            stops: [
                [0.6, '#DF5353'], 
                //[0.99, '#DDDF0D'],
                [0.99, '##FC7D00'],
                [1, '#55BF3B'] 
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
            title: {
                y: -45
            },
            labels: {
                y: 1
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
    $('#container-speed').highcharts(Highcharts.merge(gaugeOptions, {

        yAxis: {
            min: 0,
            max: <?php echo round($meta,1);?>,
            title: {
                text: 'Meta: '+<?php echo round($meta,1);?>+' días'
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
            name: 'dias',
            data: [<?php echo round($TMPR_total,1);?>],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:15px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'blue') + '">{y}</span><br/>' +
                       '<span style="font-size:12px;color:silver"> </span></div>'
            }
        }]

    }));
});
var dir1,tipo;
function nuevo(dirA,tip){
  if (typeof(dirA)=='string'){
    dir1=dirA;
    tipo=tip;
  }
  jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+dir1,
                'data':$(this).serialize()+"&tipo="+tipo,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                      if (data.status == 'failure'){
                              $('#nuevo div.divForForm').html(data.div);
                              
                              $('#nuevo div.divForForm form').submit(nuevo);
                      }
                      else{
                              $('#nuevo div.divForForm').html(data.div);
                              setTimeout("$('#nuevo').dialog('close') ",000);
          
                      }
                },
                'cache':false});
    return false; 
}
</script>

