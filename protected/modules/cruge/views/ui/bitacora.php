<?php
	/*
		$model:  es una instancia que implementa a ICrugeStoredUser
	*/
	$this->breadcrumbs=array(
	'Bitácora',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Sistema</strong></div>' , 'visible'=>'1'),
	//array('label'=>'Crear usuario', 'url'=>array('/cruge/ui/usermanagementcreate')),
	array('label'=>'Administrar usuarios', 'url'=>array('/cruge/ui/usermanagementadmin')),
	array('label'=>'Sesiones de usuarios', 'url'=>array('/cruge/ui/sessionadmin')),
	array('label'=>'Perfil', 'url'=>array('/cruge/ui/editprofile')),
	array('label'=>'Bitácora', 'url'=>array('/cruge/ui/bitacora')),
);
?>
<?php
/* @var $this BitacoraController */
/* @var $dataProvider CActiveDataProvider */

?>
<div class='crugepanel user-assignments-role-list'>
<h1>Bitácora</h1>
<div id="filtro" >
<i>Filtro por usuario: </i>

		<?php $model=new CrugeStoredUser;	
		echo CHtml::dropDownList('usuarios',$model,CHtml::listData(CrugeStoredUser::model()->findAll(),'iduser','username'),
              array('empty' => 'Todos',
                   'style'=>"width:120px;")); 
        ?>
</div>
<div id="fechas" style="float:left;">
<i>Filtro por período: </i>
		<?php echo CHtml::textField('Fechaini', '',array('style'=>'width:80px;cursor:pointer;','size'=>"10","readonly"=>'readonly','placeholder'=>"Inicio",'id'=>'inicio')); ?>
		<?php echo CHtml::textField('Fechafin', '',array('style'=>'width:80px;cursor:pointer;',"readonly"=>'readonly','disabled'=>'disabled','id'=>'fin','placeholder'=>"Fin")); 
		echo CHtml::submitButton('Buscar',array("id"=>"boton","onclick"=>"FiltrarFecha()","style"=>"float:right;margin-top:2px;margin-left:10px;")); ?>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'historico',
				//'selectionChanged'=>'validar',
				'summaryText'=>'',
			    'enableSorting' => true,
				'template'=>"{items}\n{summary}\n{pager}",
				'selectableRows'=>1,
				'emptyText'=>'No hay ordenes listas para cerrar',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'cursor:pointer'),
				'columns'=>array(
				array(
					'header'=>'Usuario',
					'name'=>'idusuario',
					'value'=>'$data->idusuario0->username',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'header'=>'Fecha y hora de evento',
					'name'=>'fecha',
					'value'=>'date("d/m/Y h:i A",strtotime($data->fecha))',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				
				array(
					'header'=>'Evento',
					'name'=>'evento',
					//'value'=>'$data->cOperativo0->nombre.\'  \'.$data->cOperativo0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				array(
					'header'=>'Entidad',
					'name'=>'tabla',
					//'value'=>'$data->cTaller0->nombre.\'  \'.$data->cTaller0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:80px'),
				),
				
			)
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

.crugepanel {
    background-color: #FFF;
    border: 1px dotted #AAA;
    border-radius: 1px;
    box-shadow: 3px 3px 5px #EEE;
    display: block;
    margin-top: 10px;
    padding: 10px;
}
[class*="span"] {
    float: left;
    min-height: 1px;
    margin-left: 30px;
    width: 600px;
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
	if($("#fin").val().length==0 && $("#inicio").val().length>0)
		$("#fin").val(hoy);
	$.fn.yiiGridView.update('historico',{ data : "fechaIni="+$("#inicio").val()+"&fechaFin="+$("#fin").val()+"&usuarios="+$("#usuarios").val()});
}
</script>

