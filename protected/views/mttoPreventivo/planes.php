<?php
/* @var $this RepuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mantenimiento preventivo'=>array('mttoPreventivo/index'),
	'Planes de mantenimiento',
);

$this->menu=array(
	array('label'=>'Crear plan de mantenimiento', 'url'=>array('crearPlan')),
);
?>
<h1>Planes de mantenimiento preventivo</h1>
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
