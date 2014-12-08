<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Calendario de mantenimientos',
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de mantenimiento</strong></div>'),
	array('label'=>'      Crear programa de mantenimiento', 'url'=>array('crearPlan')),
	array('label'=>'      Ver programas de mantenimiento', 'url'=>array('planes')),
	
	 
);
?>
<?php 
	echo phpversion();
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
				var m = moment();
				var fecha = $.datepicker.formatDate("yy-mm-dd",calEvent.start);
				if(fecha<=m){
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