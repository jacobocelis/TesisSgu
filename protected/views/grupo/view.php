<?php
/* @var $this GrupoController */
/* @var $model Grupo */


$this->breadcrumbs=array(
	'Vehiculos'=>array('vehiculo/index'),
	'Grupos registrados'=>array('index'),
	$model->grupo,
);
$this->menu=array(
	array('label'=>'<div id="menu"><strong>Opciones de grupo</strong></div>' , 'visible'=>'1'),
	array('label'=>'Ver detalle', 'url'=>array('grupo/view', 'id'=>$model->id)),
	array('label'=>'Editar grupo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar grupo', 'url'=>'' ,'linkOptions'=>array('confirm'=>'¿Confirma que desea eliminar el grupo?','onclick'=>'eliminar('.$model->id.')','style'=>'cursor:pointer;background:#FFE0E1;')),
	//array('label'=>'Administrar grupo', 'url'=>array('admin')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Detalle de grupo</h1>
<br>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	//'htmlOptions'=>array('style'=>'border: 1px solid #A8C5F0;'),
	'attributes'=>array(
		'grupo',
		'descripcion',
		array(
		'name'=>'idtipo',
		'value'=>$model->idtipo0->tipo,'type'=>'text'
		),
	),
)); ?>
<HR>
</div>
<div class='crugepanel user-assignments-role-list'>


<p class="note">
			<?php 
			/*$this->widget('zii.widgets.grid.CGridView', array(
				'dataProvider' => $atributos,
				'summaryText' => '',
					'selectableRows'=>0,
			'columns' => array(
	        array(
				'header'=>'Campos básicos de la ficha técnica para cualquier vehiculo',
	            'name' => 'id',
	            'type' => 'raw',
	       
	        ),
	    ),
	));*/
?> 
		<i>Puede agregar campos perzonalizados con información adicional</i>
			<?php 
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'campos',
			'selectableRows'=>0,
			//'ajaxUpdate' => true,
			//'afterAjaxUpdate' => "prueba",
			'dataProvider'=>$info,
			'enablePagination' => false,
			'template'=>"{items}{summary}{pager}",
			'emptyText' => '<i>no hay campos agregados a este grupo</i>',
			//'summaryText' => 'Mostrando {start}-{end} de {count} registro(s).',
			'summaryText' => '',
			'columns'=>array(	
				array(
					'header'=>'Nombre del campo',
					'name'=>'informacion',
					//'footer'=>'',
				),
				array(
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							/*'update' => array(
								'url'=>'Yii::app()->createUrl("infgrupo/update", array("id"=>$data->id))',
							),*/
							'header'=>'Actividad',
							'delete' => array(
								'url'=>'Yii::app()->createUrl("infgrupo/delete", array("id"=>$data->id))',
						),
					),
				),
			),
		));?>
<?php echo CHtml::link('agregar(+)', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{addClassroom(); $('#dialog').dialog('open');}"));?>
		</p>	
		
</div>
<br>
<div class='crugepanel user-assignments-role-list'>
<h1>Vehiculos asociados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'template'=>"{items}{summary}{pager}",
	'emptyText' => 'no hay vehiculos registrados en éste grupo',
	'itemView'=>'vehiculo',
)); /*
echo CHtml::link('Registrar vehiculo', Yii::app()->baseUrl."/vehiculo/create?grupo=".$model->id,  // the link for open the dialog
    array(
		
        'style'=>'cursor: pointer; text-decoration: underline;',
        ));*/
?>

</div>
<?php
/*ventana agregar informacion*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Agregar campo',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>370,
        'position'=>array(null,150),
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<script>
function eliminar(id){
var dir="<?php echo Yii::app()->baseUrl;?>"+"/grupo/delete/";
	$.ajax({  		
			 type: 'POST',
          url: dir+id+'?ajax=ajax',
        })
  	.done(function(result) {    	
			if(result!="")
    	     alert(result);
			if(result=="")
				window.location.replace("<?php echo Yii::app()->baseUrl."/grupo/index"?>");
  	});
}
</script>
<script>
/*window.onload=function(){
var pos=window.name || 0;
window.scrollTo(0,pos);
}
window.onunload=function(){
window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}*/
function addClassroom()
{
    <?php echo CHtml::ajax(array(
            'url'=>array('grupo/Addnew/'.$model->id),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialog div.divForForm').html(data.div);
                          // Here is the trick: on submit-> once again this function!
                    $('#dialog div.divForForm form').submit(addClassroom);
                }
                else
                {
                    $('#dialog div.divForForm').html(data.div);
                    setTimeout(\"$('#dialog').dialog('close') \",1000);
					$.fn.yiiGridView.update('campos');
					
                }
            } ",
            ))?>;
    return false; 
}
</script>
<style>
table.detail-view th, 
table.detail-view td {
    font-size: 0.9em;
    border: 1px solid #FFF;
    padding: 0.3em 0.6em;
    vertical-align: top;
    border: 1px solid #A8C5F0;
}
</style>