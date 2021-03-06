<?php 
$this->breadcrumbs=array(
	'Vehiculos'=>array('vehiculo/index'),
	'Mantenimiento preventivo'=>array('mttoPreventivo/mttopVehiculo/'.$id),
	"Unidad ".$id,
);
	$this->menu=array(
	array('label'=>'Regresar', 'url'=>array('mttoPreventivo/mttopVehiculo/'.$id)),
);
?>
<div class='crugepanel user-assignments-role-list'>
	<h1><?php echo ucfirst(CrugeTranslator::t("Registrar mantenimientos iniciales"));?></h1>

</div>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'inicial',
				'summaryText'=>'',
			    'enableSorting' => true,
				'emptyText'=>'no existen mantenimientos preventivos registrados',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'max-width:800px;'),
				'columns'=>array(
				array(
					'header'=>'Actividad',
					'name'=>'idactividadMtto',
					'value'=>'$data->idactividadMtto0->actividad',
					'htmlOptions'=>array('style'=>'text-align:center;width:150px;'),
				),
				array(
					'header'=>'Prioridad',
					'name'=>'idprioridad',
					'value'=>'$data->idprioridad0->prioridad',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
				),
				array(
					'header'=>'Fecha de último mantenimiento realizado',
					'name'=>'ultimoFecha',
					'type'=>'raw',
					'value'=>'$data->valores($data->ultimoFecha)?date("d/m/Y",strtotime($data->ultimoFecha)):$data->noasignado()',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
					'headerHtmlOptions'=>array('style'=>'width:100px;font-size: 5px;line-height: 15px;'),
				),
				array(
					'header'=>'Último mantenimiento realizado',
					'name'=>'ultimoKm',
					'type'=>'raw',
					/*'value'=>function($data){
						return '<div class="label label-info">'.$data->ultimoKm.'</div>';
					},*/
					'value'=>'number_format($data->valores($data->ultimoKm))?number_format($data->ultimoKm).\' Km \':$data->noasignado()',
					'htmlOptions'=>array('style'=>'width:100px;text-align:center;'),
				),
						array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'htmlOptions'=>array('style'=>'text-align:center;'),
						'header'=>'Registrar mantenimiento inicial',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
								
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{registrarMi("\'.Yii::app()->createUrl("actividades/update",array("id"=>$data["id"],"idestatus"=>1)).\'"); $("#dialog").dialog("open");}\'
                        )
                );',),
			)
        ));
?>
<?php
/*ventana agregar informacion*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Registrar mantenimiento inicial',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>400,
        'height'=>255,
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
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
var Uurl;
function registrarMi(id){
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
                                        $('#dialog div.divForForm form').submit(registrarMi); // updatePaymentComment
                                }
                                else
                                {
                                        $('#dialog div.divForForm').html(data.div);
                                        setTimeout("$('#dialog').dialog('close') ",1000);
                                        $.fn.yiiGridView.update('inicial');
                                }
                        } ,
                'cache':false});
    return false; 
}
</script>