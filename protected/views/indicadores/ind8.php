<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/highstock.js"); ?>
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
  <h1>Gasto totalizado</h1>
  <i>*Muestra el total de gastos realizados a los vehiculos de la flota clasificandolos por tipo. Por defecto la consulta se hace en el año en curso</i><br>
  
  <div id="filtro" style="width:20%;margin-top:10px">
<i>Por # de unidad: </i>

    <?php $model=new Vehiculo;  
    echo CHtml::dropDownList('vehiculo',$model,CHtml::listData(Vehiculo::model()->findAll(),'id','numeroUnidad'),
              array('empty' => 'Todos',
                   'style'=>"width:80px;")); 
        ?>
</div>
<div id="fechas" style="float:left;">
<i>Por período: </i>
    <?php echo CHtml::textField('Fechaini', '',array('style'=>'width:80px;cursor:pointer;','size'=>"10","readonly"=>'readonly','placeholder'=>"Inicio",'id'=>'inicio')); ?>
    <?php echo CHtml::textField('Fechafin', '',array('style'=>'width:80px;cursor:pointer;',"readonly"=>'readonly','disabled'=>'disabled','id'=>'fin','placeholder'=>"Fin")); 
    echo CHtml::submitButton('Buscar',array("id"=>"boton","onclick"=>"FiltrarFecha()","style"=>"float:right;margin-top:2px;margin-left:10px;")); ?>
</div>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'det',
    'dataProvider' => $rawData,
    'summaryText'=>'',
    //'afterAjaxUpdate' => 'js:function(id, data) {alert(id);}',
    'columns' => array(
      array(
        'header'=>'Unidad',
        'name' => 'Vehiculo',
        'type' => 'raw',
        'value'=>'str_pad((int) $data["Vehiculo"],2,"0",STR_PAD_LEFT);',
        'htmlOptions'=>array('style'=>'text-align:center;'),
      ),
      array(
        'header'=>'Mtto. preventivo',
        'name' => 'Preventivo',
        'type' => 'raw',
        'value' => 'CHtml::encode(number_format($data["Preventivo"], 2,",","."))',
        'htmlOptions'=>array('style'=>'text-align:center;'),
      ),
      array(
        'header'=>'Mtto. correctivo',           
        'name' => 'Correctivo',
        'type' => 'raw',
        'value' => 'CHtml::encode(number_format($data["Correctivo"], 2,",","."))',
        'htmlOptions'=>array('style'=>'text-align:center;'),
      ),
      array(
        
        'name' => 'Neumaticos',
        'type' => 'raw',
        'value' => 'CHtml::encode(number_format($data["Neumaticos"], 2,",","."))',
        'htmlOptions'=>array('style'=>'text-align:center;'),
      ),
      array(
        'name' => 'Combustible',
        'type' => 'raw',
        'value' => 'CHtml::encode(number_format($data["Combustible"], 2,",","."))',
        'htmlOptions'=>array('style'=>'text-align:center;'),
      ),
      array(
        'name' => 'Total',
        'type' => 'raw',
        'value' => 'CHtml::encode(number_format($data["Total"], 2,",","."))',
        'htmlOptions'=>array('style'=>'text-align:center;'),
        'footer'=>'<strong>Total: </strong>'.$vehiculo->totalGastosReporte($rawData->getData()).' Bs.',
        'footerHtmlOptions'=>array("style"=>"background: none repeat scroll 0% 0% rgba(5, 255, 0, 0.35);text-align:center"),
      ),
    ),
  )); 
?>

<?php
/*ventana agregar actividad*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'nuevaPos',
    'options'=>array(
 
        'autoOpen'=>false,
        'modal'=>true, 
    ),
));?>
<?php $this->endWidget();?>

</div>
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
  var year="<?php echo date("Y")?>";
  if($("#fin").val().length==0 && $("#inicio").val().length>0)
    $("#fin").val(hoy);
  if($("#fin").val().length==0 && $("#inicio").val().length==0){
    $("#fin").val(hoy);
    $("#inicio").val("01/01/"+year);
  }
  $.fn.yiiGridView.update('det',{ data : "fechaIni="+$("#inicio").val()+"&fechaFin="+$("#fin").val()+"&vehiculo="+$("#vehiculo").val()});
}
</script>

