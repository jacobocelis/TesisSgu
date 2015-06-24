<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Calendario de mantenimientos',
); 
$this->menu=array(
	//if(Yii::app()->user->checkAccess('xxx')):
	array('label'=>'<div id="menu"><strong>Opciones de mantenimiento</strong></div>' , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_planes')),
	array('label'=>'      Actividades de mantenimiento', 'url'=>array('mttoPreventivo/index') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_index')),
	array('label'=>'      Registrar actividades de mantenimiento', 'url'=>array('mttoPreventivo/planes') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_planes')),
	array('label'=>'      Registrar matenimientos iniciales <span id="mi" class="badge badge-'.$color.' pull-right">'.$mi.'</span>', 'url'=>array('mttoPreventivo/iniciales/') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_iniciales')),
	array('label'=>'      Ajuste de fechas en calendario', 'url'=>array('mttoPreventivo/calendario') , 'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_calendario')),
	//endif;
	
	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('mttoPreventivo/crearOrdenPreventiva') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_crearOrdenPreventiva')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('mttoPreventivo/verOrdenes') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('mttoPreventivo/cerrarOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_cerrarOrdenes')),
	
	
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de mantenimientos', 'url'=>array('mttoPreventivo/historicoPreventivo') ,'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoPreventivo')),
	array('label'=>'      Histórico de gastos', 'url'=>array('mttoPreventivo/historicoGastos'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('mttoPreventivo/historicoOrdenes'),'visible'=>Yii::app()->user->checkAccess('action_mttopreventivo_historicoOrdenes')),

	array('label'=>'<div id="menu"><strong>Administrar</strong></div>' , 'visible'=>'1'),
	array('label'=>'      Parámetros y datos maestros', 'url'=>array('mttoPreventivo/parametros')),

);
?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'dssd',
    'options'=>array(
        'autoOpen'=>false,
		'position'=>array(null,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm">

</div>
<?php $this->endWidget();?>

<?php
$this->widget('ext.EFullCalendar.EFullCalendar', array(
     'lang'=>'es',
	 'id'=>'calendar',
    // remove to use without theme
    // this is relative path to:
    // themes/<path>
    'themeCssFile'=>'cupertino/theme.css',
 
    // raw html tags
    'htmlOptions'=>array(
        'style'=>'width:100%'
    ),
    // FullCalendar's options.
    // Documentation available at
    // http://arshaw.com/fullcalendar/docs/
    'options'=>array(
        'header'=>array(
            'left'=>'prev,next',
            'center'=>'title',
            'right'=>'today',
			'droppable'=>true,
        ),
		//'weekends'=>false,
        'lazyFetching'=>true,
        'events'=>$items, // action URL for dynamic events, or
        //'events'=>array() // pass array of events directly
        // event handling
		'eventAfterRender'=>'js:function(event, element, view) {
			//$(element).css("width","100%");
		}',
		'eventDrop'=>'js:function(calEvent, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view){
				
				var fecha = $.datepicker.formatDate("dd/mm/yy",calEvent.start);
				var hoy = new Date();
				var m3 = moment("'.$hoy.'");
				var m2 = moment(fecha,"DD/MM/YYYY");
				var m1 = moment(formatDate(hoy,"dd/MM/y"),"DD/MM/YYYY");
				if(m2<m3){
					alert("No puede mover un evento a una fecha anterior al día de hoy");
					revertFunc();
				}else{
				if (!confirm("¿Está seguro?")){
					revertFunc();
				}else{
					$.ajax({
					url: "cambiarFecha/"+calEvent.id,
					"data":$(this).serialize()+ "&fecha=" + fecha,
					"type":"post",
					"dataType":"json",
					"cache":false});
					}
				}
        }',
    ),
	
));

?>
<div class="crugepanel">
<b><p>*Actividades de mantenimiento cuya fecha de realización sea un sábado o domingo automaticamente sera reajustadas al siguiente día hábil</p></b>
<b><p>*Puede indicar días feriados, las actividades seran reajustadas al siguiente día hábil.</p></b>
<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'fechas',
				//'summaryText'=>'',
				'selectableRows'=>0,
				'template'=>"{items}\n{summary}\n{pager}",
			    
				//'emptyText'=>'no hay conductores asignados',
                'dataProvider'=>$feriados,
				//'htmlOptions'=>array('style'=>'font-size: 1.0em;'),
				
				'columns'=>array(

				array(
					'header'=>'Evento',
					'name'=>'descripcion',
					//'value'=>'$data->idempleado0->nombre.\'  \'.$data->idempleado0->apellido',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
				),
				array(
					'header'=>'Fecha inicio',
					'name'=>'fechaInicio',
					'value'=>'date("d/m", strtotime($data->fechaInicio));',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
				),
				array(
					'header'=>'Fecha fin',
					'name'=>'fechaFin',
					'value'=>'date("d/m", strtotime($data->fechaFin));',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px;'),
				),
 				/*array(
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:10px;'),
					'htmlOptions'=>array('style'=>'text-align:center;width:30px;'),
					'header'=>'Cambiar conductor',
					'type'=>'raw',
					'value'=>'CHtml::link(
                    CHtml::image(Yii::app()->request->baseUrl."/imagenes/cambiar.png",
                                      "Agregar",array("title"=>"Cambiar por otro")),
                    "",
                    array(
                            \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                            \'onclick\'=>\'{cambiar("\'.Yii::app()->createUrl("empleados/cambiar",array("id"=>$data["id"])).\'");}\'
                    )
                );',),*/
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					//'deleteConfirmation'=>'¿Desea dejar la unidad sin conductor?',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("Feriado/delete", array("id"=>$data->id))', 
						),
					),
				),
			)
        ));

?>
<div id="registro"></div>
</div>

<script>
nuevoFeriado();
function nuevoFeriado(){
var dir="<?php echo Yii::app()->baseUrl."/feriado/agregar"?>";
jQuery.ajax({
                url: dir,
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#registro').html(data.div);
                                        $('#registro form').submit(nuevoFeriado);
                                }
                                else{
                                		nuevoFeriado();
                                        
										$('#resultado').html(data.mensaje);
										$.fn.yiiGridView.update('fechas');
                                }
                        } ,
                'cache':false});
		return false; 
}

var MONTH_NAMES=new Array('January','February','March','April','May','June','July','August','September','October','November','December','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
var DAY_NAMES=new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sun','Mon','Tue','Wed','Thu','Fri','Sat');
function LZ(x) {return(x<0||x>9?"":"0")+x}
function formatDate(date,format) {
	format=format+"";
	var result="";
	var i_format=0;
	var c="";
	var token="";
	var y=date.getYear()+"";
	var M=date.getMonth()+1;
	var d=date.getDate();
	var E=date.getDay();
	var H=date.getHours();
	var m=date.getMinutes();
	var s=date.getSeconds();
	var yyyy,yy,MMM,MM,dd,hh,h,mm,ss,ampm,HH,H,KK,K,kk,k;
	// Convert real date parts into formatted versions
	var value=new Object();
	if (y.length < 4) {y=""+(y-0+1900);}
	value["y"]=""+y;
	value["yyyy"]=y;
	value["yy"]=y.substring(2,4);
	value["M"]=M;
	value["MM"]=LZ(M);
	value["MMM"]=MONTH_NAMES[M-1];
	value["NNN"]=MONTH_NAMES[M+11];
	value["d"]=d;
	value["dd"]=LZ(d);
	value["E"]=DAY_NAMES[E+7];
	value["EE"]=DAY_NAMES[E];
	value["H"]=H;
	value["HH"]=LZ(H);
	if (H==0){value["h"]=12;}
	else if (H>12){value["h"]=H-12;}
	else {value["h"]=H;}
	value["hh"]=LZ(value["h"]);
	if (H>11){value["K"]=H-12;} else {value["K"]=H;}
	value["k"]=H+1;
	value["KK"]=LZ(value["K"]);
	value["kk"]=LZ(value["k"]);
	if (H > 11) { value["a"]="PM"; }
	else { value["a"]="AM"; }
	value["m"]=m;
	value["mm"]=LZ(m);
	value["s"]=s;
	value["ss"]=LZ(s);
	while (i_format < format.length) {
		c=format.charAt(i_format);
		token="";
		while ((format.charAt(i_format)==c) && (i_format < format.length)) {
			token += format.charAt(i_format++);
			}
		if (value[token] != null) { result=result + value[token]; }
		else { result=result + token; }
		}
	return result;
}
var Uurl;
function agregarFeriado(){
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Feriado/agregar",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                    if (data.status == 'failure'){
                            //$('#dialog div.divForForm').html(data.div);
							$('#agregarFeriado div.divForForm').html(data.div);
                            // Here is the trick: on submit-> once again this function!
                            //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
							$('#agregarFeriado div.divForForm form').submit(agregarFeriado);
                    }
                    else{
                            //$('#dialog div.divForForm').html(data.div);
							$('#agregarFeriado div.divForForm').html(data.div);
                            //setTimeout("agregarActividad()",1000);
                            $('#agregarFeriado').dialog('close');
							$.fn.yiiGridView.update('fechas');
                    }
                } ,
                'cache':false});
    return false; 
}
</script>