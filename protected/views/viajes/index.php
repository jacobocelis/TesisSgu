<?php
/* @var $this ViajesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Viajes',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Viajes</strong></div>'),
	array('label'=>'Registrar viajes rutinarios', 'url'=>array('rutinarios')),
	array('label'=>'Registrar viajes especiales', 'url'=>array('especiales')),
	array('label'=>'<div id="menu"><strong>Historial</strong></div>'),
	array('label'=>'Histórico de viajes', 'url'=>array('admin')),
	array('label'=>'Estadísticas de viajes', 'url'=>array('admin')),
);
?>
<div class='crugepanel user-assignments-detail'>
<h1></h1>
</div>
<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'viaje',
    'options'=>array(
        'title'=>'Registrar viaje realizado',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
		'position'=>array(500,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<style>
.crugepanel {
    background-color: #FFF;
    border: 1px dotted #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
}
#menu {
    font-size: 15px;
}
</style>
<style>
.grid-view table.items th {
	color: rgba(0, 0, 0, 1);
    text-align: center;
    background: none repeat scroll 0% 0% rgba(0, 138, 255, 0.15);
}
.grid-view table.items th a {
    color: #000;
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
<script>
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
	        dateFormat: 'yy-mm-dd',
	        firstDay: 1,
	        isRTL: false,
			changeMonth: true,
            changeYear: true,
	        showMonthAfterYear: false,
	        yearSuffix: '',
	        maxDate: '0d',
	        //minDate: '0d',
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
	});      		
	$("#fecha").datepicker({
		onSelect: function(selected){
			var fecha=$('#fecha').val();
			$.fn.yiiGridView.update('viajes',{data:"fecha="+fecha});
		}
});
</script>
<script>
function agregarViaje(){
$('#viaje').dialog('open');
	var fecha=$('#fecha').val();
	var dir="<?php echo Yii::app()->baseUrl."/viajes/agregarViaje/"?>";
	jQuery.ajax({
                url: dir,
                'data':$(this).serialize()+"&fecha="+fecha,
                'type':'post',
                'dataType':'json',
                'success':function(data){
                                if (data.status == 'failure'){
                                        $('#viaje div.divForForm').html(data.div);
                                        $('#viaje div.divForForm form').submit(agregarViaje); // updatePaymentComment
                                }
                                else{
                                        $('#viaje div.divForForm').html(data.div);
                                        setTimeout("$('#viaje').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('viajes');
										
                                }
                        },
                'cache':false});
    return false; 
}
</script>