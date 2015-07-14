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
       <h1 style="width:100%;">Porcentaje de incidentes por unidad</h1><br>
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
            'text' => '',
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
</script>
