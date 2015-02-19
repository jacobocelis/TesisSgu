<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Calendario de mantenimientos',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de mantenimiento</strong></div>'),
	array('label'=>'      Registrar actividades de mantenimiento', 'url'=>array('planes')),
	array('label'=>'      Registrar matenimientos iniciales <span id="mi" class="badge badge-'.$color.' pull-right">'.$mi.'</span>', 'url'=>array('mttoPreventivo/iniciales/')),
	array('label'=>'      Ajuste de fechas en calendario', 'url'=>array('mttoPreventivo/calendario')),
	
	
	array('label'=>'<div id="menu"><strong>Órdenes de mantenimiento</strong></div>'),
	array('label'=>'      Crear orden de mantenimiento', 'url'=>array('crearOrdenPreventiva')),
	array('label'=>'      Ver órdenes abiertas <span class="badge badge-'.$Colorabi.' pull-right">'.$abiertas.'</span>', 'url'=>array('verOrdenes')),
	array('label'=>'      Órdenes listas para cerrar <span class="badge badge-'.$Colorli.' pull-right">'.$listas.'</span>', 'url'=>array('cerrarOrdenes')),
	
	array('label'=>'<div id="menu"><strong>Gestión de coordinadores</strong></div>'),
	array('label'=>'      Coordinador operativo y de transporte', 'url'=>array('empleados/coordinadores')),
	
	
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'      Histórico de mantenimientos', 'url'=>array('historicoPreventivo')),
	array('label'=>'      Histórico de gastos', 'url'=>array('historicoGastos')),
	array('label'=>'      Histórico de ordenes', 'url'=>array('historicoOrdenes')),
);
?>
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
				var m1 = moment();
				m1.format("L");
				var fecha = $.datepicker.formatDate("mm/dd/yy",calEvent.start);
				var m2 = moment(fecha,"MM/DD/YYYY");
				m2.format("L");
				alert(fecha);
				if(m1<m2){
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

<script>

</script>