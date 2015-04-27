<?php
/* @var $this ViajesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	//'Viajes'=>array('viajes/index'),
	'Proveedores',
);

$this->menu=array(

);
?>
<div class='crugepanel user-assignments-detail'>
<h1>Registro de proveedores</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'proveedores',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
			    'enableSorting' => true,
				'emptyText'=>'no hay proveedores',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;'),
				
				'columns'=>array(
				array(
					'header'=>'Nombre',
					'name'=>'nombre',
					'value'=>'$data->nombre',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
			

				array(
					'header'=>'RIF',
					'name'=>'RIF',
				 
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Dirección',
					'name'=>'direccion',
					//'value'=>'$data->idtipoEmpleado0->tipo',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'header'=>'Teléfono',
					'name'=>'telefono',
					//'value'=>'$data->idtipoEmpleado0->tipo',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				
				array(
						'headerHtmlOptions'=>array('style'=>'text-align:center;width:10px;'),
						'htmlOptions'=>array('style'=>'text-align:center;width:30px;'),
						'header'=>'Modificar',
						'type'=>'raw',
						'value'=>'CHtml::link(
                        CHtml::image(Yii::app()->request->baseUrl."/imagenes/agregar.png",
                                          "Agregar",array("title"=>"Editar")),
                        "",
                        array(
                                \'style\'=>\'cursor: pointer;text-decoration: underline;text-align:center;\',
                                \'onclick\'=>\'{editarProveedor("\'.Yii::app()->createUrl("proveedor/actualizar",array("id"=>$data["id"])).\'"); $("#proveedor").dialog("open");}\'
                        )
                );',),
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("proveedor/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
?>
<?php echo CHtml::link('Registrar proveedor', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{agregarProveedor(); $('#proveedor').dialog('open');}"));
		?>
</div>

<?php
/*ventana agregar recurso*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'proveedor',
    'options'=>array(
        'title'=>'Datos del proveedor',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>390,
		'position'=>array(500,100),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
 
 
<script>
var Uurl;
function agregarProveedor(){
	jQuery.ajax({
                url: "<?php echo Yii::app()->baseUrl;?>"+"/Proveedor/agregar",
                'data':$(this).serialize(),
                'type':'post',
                'dataType':'json',
                'success':function(data){
                        if (data.status == 'failure'){
                                //$('#dialog div.divForForm').html(data.div);
								$('#proveedor div.divForForm').html(data.div);
                                // Here is the trick: on submit-> once again this function!
                                //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
								$('#proveedor div.divForForm form').submit(agregarProveedor);
								//$("#link").hide();
								//$("#agreAct").show();
								//$('body').scrollTo('#agreAct',{duration:'slow', offsetTop : '50'});
								//$.scrollTo($('#agreAct').offset().top-100, { duration:300});
                        }
                        else{
                                //$('#dialog div.divForForm').html(data.div);
								$('#proveedor div.divForForm').html(data.div);
                                //setTimeout("agregarActividad()",1000);
                                $('#proveedor').dialog('close');
								$.fn.yiiGridView.update('proveedores');
                        }
                    },
                'cache':false});
    return false; 
}
function editarProveedor(id){

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
                                        $('#proveedor div.divForForm').html(data.div);
                                        // Here is the trick: on submit-> once again this function!
                                        //$('#dialog div.divForForm form').submit(agregarActividad); // updatePaymentComment
										$('#proveedor div.divForForm form').submit(editarProveedor);
                                }
                                else
                                {
                                        $('#proveedor div.divForForm').html(data.div);
                                        //setTimeout("agregarActividad()",1000);
                                        $('#proveedor').dialog('close');
										$.fn.yiiGridView.update('proveedores');
                                }
                        } ,
                'cache':false});
    return false; 
}
</script>