<?php

$this->breadcrumbs=array(
	'Indicadores y reportes',
);

$this->menu=array(
	array('label'=>'<div id="menu"><strong>Indicadores</strong></div>' , 'visible'=>'1'),
	array('label'=>'      % de incidentes por conductor', 'url'=>array('Indicadores/ind1')),
 
);
?>
<div class="crugepanel">
<?php
$this->widget('ext.highcharts.HighchartsWidget', array(
    'scripts' => array(
        'modules/exporting',
        'themes/grid-light',
    ),
    'options' => array(
    	'chart'=>array(
			'type'=>'pie',
			 'options3d'=>array(
                'enabled'=> true,
                'alpha'=> 45,
                'beta'=> 0
			),
		),
        'title' => array(
            'text' => 'Porcentaje de incidentes de acuerdo a los conductores involucrados',
        ),
 		'tooltip'=> array(
            'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>'
        ),
 		'plotOptions'=> array(
            'pie'=> array(
                'allowPointSelect'=> true,
                'cursor'=> 'pointer',
                'depth'=> 35,
                'dataLabels'=> array(
                    'enabled'=> true,
                    'format'=> '{point.name}'
                ),
            ),
        ),
		   'series' => array (
		        array (
		          'type' => 'pie',
		          'name' => 'Incidentes',
		          'data' => array (
		           array('J. Marcel', 44.2),
		           array('A. Carrero', 26.6),
		           array('L. Parra', 20),
		           array('J. León', 3.1),
		           array('G. mora', 5.4)
		        ),
		    ),
		),
    )
));
 
?>
</div>
 

