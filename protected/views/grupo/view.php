<?php
/* @var $this GrupoController */
/* @var $model Grupo */

$this->breadcrumbs=array(
	'Grupo'=>array('index'),
	$model->grupo,
);

$this->menu=array(
	array('label'=>'Listar grupos', 'url'=>array('index')),
	array('label'=>'Crear grupo', 'url'=>array('create')),
	array('label'=>'Actualizar grupo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar grupo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Está seguro que desea eliminar éste grupo?')),
	array('label'=>'Administrar grupo', 'url'=>array('admin')),
);
?>
<div class='crugepanel user-assignments-role-list'>
<h1>Detalle de grupo</h1>
<br>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
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
			$this->widget('zii.widgets.grid.CGridView', array(
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
	));
?> 
		Puede agregar campos adicionales que se le solicitarán rellenar en la ficha técnica de cada vehiculo del grupo.
		
			<HR>
			<strong><p class="note"> Campos adicionales: </p></strong>
			<?php 
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'campos',
			'selectableRows'=>0,
			//'ajaxUpdate' => true,
			//'afterAjaxUpdate' => "prueba",
			'dataProvider'=>$info,
			'enablePagination' => false,
			'template'=>"{items}{summary}{pager}",
			'emptyText' => 'no hay campos agregados a este grupo',
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
							'update' => array(
								//'label'=>'Send an e-mail to this user',
								//'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
								'url'=>'Yii::app()->createUrl("infgrupo/update", array("id"=>$data->id))',
							),
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
		<HR>
</div>
<br>
<div class='crugepanel user-assignments-role-list'>
<h1>Vehiculos asociados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'template'=>"{items}{summary}{pager}",
	'emptyText' => 'no hay vehiculos registrados en éste grupo',
	'itemView'=>'vehiculo',
)); ?>
<HR>
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
        'height'=>240,
		'resizable'=>false
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>
<style>
div.user-assignments-role-list {
}
.crugepanel {
    background-color: white;
    border: 1px dotted #aaa;
    border-radius: 5px;
    box-shadow: 3px 3px 5px #eee;
    display: block;
    margin-top: 10px;
    
    padding: 10px;
}
.grid-view table.items th {
    background: #f8f8f8;
    color: black;
    text-align: center;
}
.grid-view table.items th a {
    color: #000;
    font-weight: bold;
    text-decoration: none;
}
.grid-view table.items th a:hover {
    color: #000;
    font-weight: bold;
    text-decoration: none;
}
.grid-view table.items th {
    background: #f8f8f8;
	color:black;
    text-align: center;
}
</style>
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