<?php
/* @var $this CombustibleController */
/* @var $model Historicocombustible */

$this->breadcrumbs=array(
	'Historicocombustibles'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'      Autonomía de combustible', 'url'=>array('autonomia')),
	array('label'=>'      Histórico de reposición', 'url'=>array('admin')),
	//array('label'=>'      Estadísticas', 'url'=>array('admin')),
);
?>

<h1>Histórico de reposiciones</h1>
</div><!-- search-form -->
<?php
$this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'comb',
				'summaryText'=>'',
				'selectableRows'=>1,
				'template'=>"{items}\n{summary}\n{pager}",
				'emptyText'=>'no se han registrado reposiciones',
                'dataProvider'=>$dataProvider,
				'htmlOptions'=>array('style'=>'font-size: 1.0em;'),
				'columns'=>array(
				
				
				array(
					'header'=>'Unidad',
					'name'=>'idvehiculo',
					'value'=>'str_pad((int) $data->idvehiculo0->numeroUnidad,2,"0",STR_PAD_LEFT);',
					//'value'=>'$data->idplan0->idplanGrupo0->CompiledColour->$data-id.\' \'.$data->CompiledColour',
					'htmlOptions'=>array('style'=>'text-align:center;width:40px'),
				),
				array(
					'header'=>'Litros',
					'name'=>'litros',
					//'value'=>'$data->idfalla0->falla',
					'htmlOptions'=>array('style'=>'text-align:center;width:25px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Combustible',
					'name'=>'idcombust',
					'value'=>'$data->idcombust0->tipo',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
				array(
					'header'=>'Conductor',
					'name'=>'idempleado',
					'value'=>'$data->idconductor0->nombre.\' \'.$data->idconductor0->apellido',
					'htmlOptions'=>array('style'=>'text-align:center;width:100px'),
				),
				array(
					'header'=>'Estación',
					'name'=>'idestacionServicio',
					'value'=>'$data->idestacionServicio0->nombre',
					'htmlOptions'=>array('style'=>'text-align:center;width:60px'),
				),
				array(
					'type'=>'raw',
					'header'=>'Última reposición',
					'name'=>'fecha',
					'value'=>'$data->fechaReposicion($data->fecha)',
					'htmlOptions'=>array('style'=>'text-align:center;width:50px'),
				),
			
				array(
					'header'=>'Eliminar',
					'class'=>'CButtonColumn',
					 'template'=>'{delete}',
					     'buttons'=>array(
							'delete' => array(
								'url'=>'Yii::app()->createUrl("combustible/delete", array("id"=>$data->id))',
						),
					),
				),
			)
        ));
?>