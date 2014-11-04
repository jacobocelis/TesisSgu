
<?php $this->widget('ext.SilcomTreeGridView.SilcomTreeGridView', array(
                'id'=>'plan',
				'summaryText' => '',
                'treeViewOptions'=>array(
				'clickableNodeNames'=>false,
                    'initialState'=>'Collapse',
                    'expandable'=>true,
					'indent'=>30,
                ),
               'parentColumn'=>'idplanGrupo',
                'dataProvider'=>$dataProvider,
				'columns'=>array(
					'parte'
				)

        ));
?>