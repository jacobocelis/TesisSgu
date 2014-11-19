<div class='crugepanel user-assignments-detail'>
<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
				'htmlOptions' => array('class' => 'vista'),
                'id'=>'head',
				'summaryText'=>'',
			    'enableSorting' => false,
				'emptyText'=>'',
                'dataProvider'=>$vacio,
				'columns'=>array(
				array(
					'header'=>'Partes y piezas asignadas en el grupo seleccionado',
					'name'=>'parte',
					//'htmlOptions'=>array('style'=>'width:380px;'),
				),
			)
        ));
?>
<?php $this->widget('application.extensions.SilcomTreeGridView.SilcomTreeGridView', array(
                'id'=>'plan',
				'summaryText' => '',
				'hideHeader'=>true,
				//'htmlOptions'=>array('style'=>'border: 1px solid #94A8FF;'),
				
				'selectionChanged'=>'mostrarDetalles',
                'treeViewOptions'=>array(
				'clickableNodeNames'=>false,
                    'initialState'=>'Collapse',
                    'expandable'=>true,
					'indent'=>30, 
                ),
               'parentColumn'=>'idplanGrupo',
                'dataProvider'=>$dataProvider,
				'columns'=>array(
					'parte',	
				)
        ));
?>
</div>
<div id='activ' class='crugepanel user-assignments-detail'>
			<div id='actividades'>Actividades</div>
			<div id='pieza'></div>
			<?php 
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'act',
			'selectableRows'=>1,
			'dataProvider'=>$actividades,
			'enablePagination' => false,
			'template'=>"{items}{summary}{pager}",
			'emptyText' => 'no hay actividades agregadas',
			'summaryText' => '',
			'selectionChanged'=>'mostrarRecursos',
			'columns'=>array(	
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Actividad',
					'name'=>'actividad',
					//'footer'=>'',
				),
				array(
					'type'=>'raw',
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Frecuencia',
					'name'=>'frecuenciaKm',
					'value'=>'number_format($data->frecuenciaKm).\' Km \'.($data->frecuenciaMes ? \'<br>ó máximo cada \'.$data->frecuenciaMes.\' \'.$data->idtiempof0->tiempo :\'\')',
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Duración',
					'name'=>'duracion',
					'value'=>'$data->duracion.\' \'.$data->idtiempod0->tiempo',
					//'footer'=>'',
				),
				array(
					'headerHtmlOptions'=>array('style'=>'text-align:left;'),
					'header'=>'Prioridad',
					'name'=>'idprioridad',
					'value'=>'$data->idprioridad0->prioridad',
					//'footer'=>'',
				),
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:left;width:30px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Editar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarActividad("\'.Yii::app()->createUrl("actividadesgrupo/update",array("id"=>$data["id"])).\'"); $("#dialog").dialog("open");}\'
                        )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("actividadesgrupo/delete", array("id"=>$data->id))',
						),
					),
				),
			),
		));?>
<?php echo CHtml::link('agregar actividad(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarActividad(); }"));
		?>	
	</div>
<div id='recur' class='crugepanel user-assignments-detail'>
			<div id='recursos'>Recursos</div>
			<div id='recurso'></div>
			
<?php echo CHtml::link('agregar recurso(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarRecurso(); }"));
		?>	
</div>
<?php
/*ventana agregar actividad*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Agregar actividad',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>550,
        'height'=>480,
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<script>
/*
$('#plan > table > tbody > tr').live('click',function(){
									if($(this).hasClass('selected'))
                                       $(this).addClass('selected') 
                                });*/
function ObtenerParte(){
	var id = $.fn.yiiGridView.getSelection('plan');
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/ObtenerParte/"+id;
	$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#pieza').text("Selección: "+result);
  	});
      }
	  
function ObtenerActividad(){
	var id = $.fn.yiiGridView.getSelection('plan');
	var dir="<?php echo Yii::app()->baseUrl;?>"+"/mttoPreventivo/ObtenerParte/"+id;
	$.ajax({  		
          url: dir,
        })
  	.done(function( result ) {    	
    	     $('#recurso').text("Selección: "+result);
  	});
      }
</script>
<script>
$('#activ').hide();
$('#recur').hide();
var Uurl;
function editarActividad(id){
$('#dialog').dialog('open');
	 if (typeof(id)=='string')
                Uurl=id;
	jQuery.ajax({
                url: Uurl,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data)
                        {
                                if (data.status == 'failure')
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog div.divForForm form').submit(editarActividad); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('act');
                                }
                        } ,
                'cache':false});
    return false; 
}
function agregarActividad(){
$('#dialog').dialog('open');
	var idPlan = $.fn.yiiGridView.getSelection('plan');
	jQuery.ajax({
                url: "agregarActividad/"+idPlan,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#dialog div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
                                }
                                else{
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('act');
                                }
                        } ,
                'cache':false});
    return false; 
}
var Uurl;
function editarRecurso(id){
$('#dialog').dialog('open');
	 if (typeof(id)=='string')
                Uurl=id;
	jQuery.ajax({
                url: Uurl,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data)
                        {
                                if (data.status == 'failure')
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog div.divForForm form').submit(editarActividad); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('act');
                                }
                        } ,
                'cache':false});
    return false; 
}
function agregarRecurso(){
$('#dialog').dialog('open');
	var idPlan = $.fn.yiiGridView.getSelection('plan');
	jQuery.ajax({
                url: "agregarActividad/"+idPlan,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#dialog div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        $('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
                                }
                                else{
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('act');
                                }
                        } ,
                'cache':false});
    return false; 
}
function mostrarDetalles(){
ObtenerParte();
var altura = $(document).height();
//$("html, body").animate({scrollTop:altura+"px"},500);
$('#activ').show(500);
	var grupoSel="<?php echo $grupoSel; ?>" ;
	var idPlan = $.fn.yiiGridView.getSelection('plan');
	if(idPlan=="")
		$('#activ').hide();
	$.fn.yiiGridView.update('act',{ data : "idPlan="+idPlan+"&grupoSel="+grupoSel});
}
function mostrarRecursos(){
//ObtenerActividad();
var altura = $(document).height();
//$("html, body").animate({scrollTop:altura+"px"},500);
$('#recur').show(500);
	var grupoSel="<?php echo $grupoSel; ?>" ;
	var idAct = $.fn.yiiGridView.getSelection('act');
	if(idAct=="")
		$('#recur').hide();
	//$.fn.yiiGridView.update('act',{ data : "idPlan="+idPlan+"&grupoSel="+grupoSel});
}
</script>
<style>
#actividades{
	font-weight: bold;
	font-size: 14px !important;
	font-family: "Carrois Gothic",sans-serif;
	border-radius: 3px;
	text-align: center;
	padding: 5px;
	margin-bottom: 10px;
	color: #000;
	background: none repeat scroll 0% 0% #C6DDED;
	text-align: center;
}
#pieza{
	font-weight: bold;
	border-radius: 3px;
	text-align: left;
	padding: 5px;
	color: rgba(255, 0, 0, 1);
	font-size:120%;
	background-color: #EFEFEF;
}
#recursos{
	font-weight: bold;
	font-size: 14px !important;
	font-family: "Carrois Gothic",sans-serif;
	border-radius: 3px;
	text-align: center;
	padding: 5px;
	margin-bottom: 10px;
	color: #000;
	background: none repeat scroll 0% 0% #C6DDED;
	text-align: center;
}
#recurso{
	font-weight: bold;
	border-radius: 3px;
	text-align: left;
	padding: 5px;
	color: rgba(255, 0, 0, 1);
	font-size:120%;
	background-color: #EFEFEF;
}
.grid-view {
    padding: 10px 0px;
    overflow-x: auto;
    max-height: 350px;
}

</style>
<style>
.vista
{
	padding: 0px 0px;
}

.vista table.items
{
	background: white;
	border-collapse: collapse;
	width: 100%;
	border: 1px #D0E3EF solid;
}


.vista table.items th, .grid-view table.items td
{
	font-size: 0.9em;
	border: 1px white solid;
	padding: 0.3em;
	border: 1px solid #94A8FF;
}

.vista table.items th
{
	color: black;
	background: #C6DDED;
	text-align: center;
}

.vista table.items th a
{
	color: black;
	font-weight: bold;
	text-decoration: none;
}

.vista table.items th a:hover
{
	color: black;
}

.vista table.items th a.asc
{
	background:url(up.gif) right center no-repeat;
	padding-right: 10px;
}

.vista table.items th a.desc
{
	background:url(down.gif) right center no-repeat;
	padding-right: 10px;
}

.vista table.items tr.even
{
	background: #F8F8F8;
}

.vista table.items tr.odd
{
	background: #E5F1F4;
}

.vista table.items tr.selected
{
	background: #BCE774;
}

.vista table.items tr:hover.selected
{
	background: #CCFF66;
}

.vista table.items tbody tr:hover
{
	background: #ECFBD4;
}

.vista .link-column img
{
	border: 0;
}

.vista .button-column
{
	text-align: center;
	width: 60px;
}

.vista .button-column img
{
	border: 0;
}

.vista .checkbox-column
{
	width: 15px;
}

.vista .summary
{
	margin: 0 0 5px 0;
	text-align: right;
}

.vista .pager
{
	margin: 5px 0 0 0;
	text-align: right;
}

.vista .empty
{
	font-style: italic;
}

.vista .filters input,
.vista .filters select
{
	width: 100%;
	border: 1px solid #ccc;
}
.grid-view table.items {
    border-collapse: collapse;
    background: none repeat scroll 0% 0% #E5F1F4;
}
</style>