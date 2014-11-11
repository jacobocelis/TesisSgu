<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mantenimiento preventivo',
);

$this->menu=array(
	array('label'=>'Crear planes', 'url'=>array('crearPlan')),
	array('label'=>'Ver planes', 'url'=>array('planes')),
);
?>
<h1>Mantenimiento preventivo</h1>
<?php /*
$this->widget('ext.SilcomTreeGridView.SilcomTreeGridView', array(
                'id'=>'your-grid-id',
                'treeViewOptions'=>array(
                    'initialState'=>'collapsed',
                    'expandable'=>true,
                ),
                'parentColumn'=>'id',
                'dataProvider'=>$dataProvider,
        ));*/
?>
