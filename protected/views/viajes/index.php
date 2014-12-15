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

<?php
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
		'chart'=>array(
			'type'=>'pie'
		),
		'title' => array(
			'text' => 'Total de viajes clasificados por tipo A,B,C en lo que va de año 2014',
			'style'=>array('fontSize'=>'26px'),
		),
		'yAxis' => array(
			
			'title'=>array('text'=>'Viajes'),
		),
		'xAxis' => array(
			'categories' => array('01', '05', '44', '38', '22', '16'),
			'title'=>array('text'=>'Unidades'),
            
  
		),
		'labels' => array(
			'items' => array('html' => 'Total por tipo',
							'style'=>array('left'=>'50px',
											'top'=>'18px',
											'color'=>'(Highcharts.theme && Highcharts.theme.textColor) || "black"',
											),
							)
		),
		'series' => array(
			
			array('type'=>'column','name' => 'A', 'data' => array(375, 278, 415,470,364,418)),
			array('type'=>'column','name' => 'B', 'data' => array(24, 12, 28,12,10,14)),
			array('type'=>'column','name' => 'C', 'data' => array(70, 05, 10,10,8,9)),
			
			array('type'=>'spline','name' => 'Promedio', 'data' => array(156, 135, 254,178,214,123)),
			
			
			array('type'=>'pie','name' => 'Total Viajes', 'data' => array(
					array('name'=>'A','y'=>375),
					array('name'=>'B','y'=>75),
					array('name'=>'C','y'=>25)),
					'size'=>70,
					'center'=>array(90,40),
			),
      ),
	    'tooltip'=>array(
            'headerFormat'=>'<span style="font-size:10px">{point.key}</span><table>',
            'pointFormat'=>'<tr><td style="color:{series.color};padding:0">{series.name}: </td><td style="padding:0"><b>{point.y:.f} Viajes</b></td></tr>',
            'footerFormat'=> '</table>',
            'shared'=> true,
            'useHTML'=> true,
        ),
   )
));

	?>
	</div>
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