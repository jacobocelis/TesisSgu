<?php 
	$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Calendario de mantenimientos',
);
$this->menu=array(
	array('label'=>'Crear planes', 'url'=>array('crearPlan')),
	array('label'=>'Ver planes', 'url'=>array('planes')),
	array('label'=>'mantenimientos abiertos', 'url'=>array('planes')),
	array('label'=>'Histórico de mantenimientos', 'url'=>array('planes')),
	array('label'=>'Regresar', 'url'=>array('index')),
);
?>
<?php $this->widget('ext.EFullCalendar.EFullCalendar', array(
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
				if(calEvent.start<=m){
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