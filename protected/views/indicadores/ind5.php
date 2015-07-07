<style>
.fuente {
  font-size: 40px;
}
</style>
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
<h1>Costo de mantenimiento por valor de reposición</h1>
<i>*indica si conviene seguir realizando mantenimientos a una unidad o si es preferible reemplazarla por una nueva.</i><br>
<i>*El valor de reposición se refiere al costo de un vehiculo nuevo.</i><br><br>
<i style="float:left">Buscar vehiculo por #:</i><br>
    <?php $model=new Vehiculo;
    echo CHtml::dropDownList('vehiculos','id',CHtml::listData(Vehiculo::model()->findAll('activo=1'),'id','numeroUnidad'),array('prompt'=>'Seleccione ','style' => 'width:110px;float:left')); 
    echo CHtml::button('Buscar',array("id"=>"boton","onclick"=>"actualizar($('#vehiculos').val());","style"=>"float:left;margin-top:2px;margin-left:10px;")); ?>
</div>
<div id="panel1" class="crugepanel" style="display:none">
<?php 
  $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$veh,
    'emptyText'=>'Seleccione un vehiculo',
    'summaryText'=>'',
    'id'=>"listaVeh",
    'itemView'=>'vehiculos',
  ));
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'det',
    'dataProvider' => $rawData,
    'summaryText'=>'',
    'htmlOptions'=>array('style'=>'display:none'),
    //'afterAjaxUpdate' => 'js:function(id, data) {alert(id);}',
    'columns' => array(
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
        'name' => 'Gasto totalizado Bs.',
        'type' => 'raw',
        'value' => 'CHtml::encode(number_format($data["Total"], 2,",","."))',
        'htmlOptions'=>array('style'=>'text-align:center;'),
      ),
    ),
  )); 
?>
<div style="float:left;width:180px;">
<?php 
echo "<b>Valor de reposición:</b>";?><br>
<?php echo CHtml::textField('Text', '',
 array('id'=>'reposicion', 
       'width'=>100,
       'style'=>'width:120px', 
       'maxlength'=>100)); ?> Bs.<br>
       <?php echo CHtml::button('Calcular',array("id"=>"boton","onclick"=>"calcular($('#vehiculos').val());","style"=>"margin-top:2px;"));?>
</div>
<div id="resultado" style="display:none;float:left;width:80%;margin-top: 30px;">
<span id="etiqueta" class="label label-success fuente"></span><br><br>
<i>Sí el resultado es mayor o igual a 100% se ha gastado más en mantenimiento que lo que vale la unidad nueva</i>
</div>
</div>
<script>

function actualizar(id){
  if(id!="")
    $("#panel1").show();
  else
    $("#panel1").hide();
    $.fn.yiiListView.update('listaVeh',{ data : "idveh="+id});
    $.fn.yiiGridView.update('det',{ data : "idveh="+id});
}
function calcular(id){

  jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/indicadores/ind5/",
                'data':"id="+id+"&valor="+$("#reposicion").val(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                $('#resultado').show();
                    //$('#mi').removeClass($('#mi').attr('class')).addClass('badge badge-'+result.color+' pull-right');
                    //$('#mi').text(result.total);
                if(data.valor>=100)
                  $('#etiqueta').removeClass($('#etiqueta').attr('class')).addClass('label label-warning fuente'); 
                else
                  $('#etiqueta').addClass('label label-success fuente'); 
                      
                  $("#etiqueta").text(data.valor+"%");
                },
                'cache':false});
    return false;  
}
</script>

