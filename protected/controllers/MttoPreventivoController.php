<?php

class MttoPreventivoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','crearPlan','planes','agregarActividad','obtenerParte','mttopVehiculo','mttopIniciales'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionMttopVehiculo($id){
	
		$dataProvider=new CActiveDataProvider('Actividades',array('criteria' => array(
			'condition' =>'idplan in (select id from sgu_plan where idvehiculo="'.$id.'") and idestatus<>1 and idestatus<>3')
			,'pagination'=>array('pageSize'=>9999999)));
			
		$mi=Yii::app()->db->createCommand("select count(*) as total from sgu_actividades where idestatus=1 and idplan in(select id from sgu_plan where idvehiculo=".$id.")")->queryRow();
		$this->render('mttopVehiculo',array(
			'id'=>$id,
			'dataProvider'=>$dataProvider,
			'mi'=>$mi["total"]
		));
	}
	public function actionMttopIniciales($id){
		$dataProvider=new CActiveDataProvider('Actividades',array('criteria' => array(
			'condition' =>'idplan in (select id from sgu_plan where idvehiculo="'.$id.'") and idestatus <>3 ')
			,'pagination'=>array('pageSize'=>9999999)));
		$this->render('mttopIniciales',array(
			'id'=>$id,
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAgregarActividad($id){
                $model=new Actividadesgrupo;
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
 
    if(isset($_POST['Actividadesgrupo'])){
            $model->attributes=$_POST['Actividadesgrupo'];
            if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
				   /*inserts por debajo del plan de mantenimiento a cada vehiculo del grupo*/
				$modelo=Plangrupo::model()->findByPk($id);
				$totalVeh=Yii::app()->db->createCommand('select id from sgu_vehiculo where idgrupo="'.$modelo->idgrupo.'"')->queryAll();
				$total=count($totalVeh);
				
				for($i=0;$i<$total;$i++){
					$existe=Yii::app()->db->createCommand('select id from sgu_plan where idvehiculo="'.$totalVeh[$i]['id'].'" and idplanGrupo="'.$id.'"')->queryAll();
					if(count($existe)==0){
						Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_plan` (`idvehiculo`,`idplanGrupo`)
						VALUES (".$totalVeh[$i]['id'].",".$id.")")->query();
						
						$ultimo=Yii::app()->db->createCommand('select id from sgu_plan order by id desc limit 1')->queryRow();
					/**/
					//file_put_contents('pruebaa.txt', print_r($model,true));
						Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_actividades` (`actividad`,`frecuenciaKm`,`frecuenciaMes`,`duracion`,`idprioridad`,`idplan`,`idtiempod`,`idtiempof`,`idactividadesGrupo`,`idestatus`)
						VALUES ('".$model->actividad."',".$model->frecuenciaKm.",'".$model->frecuenciaMes."',".$model->duracion.",".$model->idprioridad.",".$ultimo["id"].",".$model->idtiempod.",".$model->idtiempof.",".$model->id.",1)")->query();
					}else{
							//file_put_contents('prueba.txt', print_r($model,true));
							Yii::app()->db->createCommand("INSERT  INTO `tsg`.`sgu_actividades` (`actividad`,`frecuenciaKm`,`frecuenciaMes`,`duracion`,`idprioridad`,`idplan`,`idtiempod`,`idtiempof`,`idactividadesGrupo`,`idestatus`)
						VALUES ('".$model->actividad."',".$model->frecuenciaKm.",'".$model->frecuenciaMes."',".$model->duracion.",".$model->idprioridad.",".$existe[0]["id"].",".$model->idtiempod.",".$model->idtiempof.",".$model->id.",1)")->query();
					}
				}
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se agregó la actividad correctamente"
                        ));
                    exit;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formActGrupo', array('model'=>$model,'id'=>$id), true)));
            exit;               
        }
        /*else
            $this->render('create',array('model'=>$model,));*/
	}
	public function actionObtenerParte($id){
	$parte=Yii::app()->db->createCommand('select concat_ws(" / ",(select parte from sgu_plangrupo c1 where c1.id=c2.idplanGrupo),c2.parte) as parte from sgu_plangrupo c2
	where c2.id="'.$id.'"')->queryRow();
    echo $parte["parte"];
}
	public function actionPlanes(){
		/*"select concat_ws(' / ',(select parte from sgu_plangrupo c1 where c1.id=c2.idplanGrupo),c2.parte) as parte from sgu_plangrupo c2
where c2.id=4;"*/
	
		$grupo=Grupo::model()->findAll();
		$this->render('planes',array(
			'grupo'=>$grupo,
		));
	}
	public function actionCrearPlan()
	{
		//file_put_contents('pruebaa.txt', print_r("hola",true));
	$idplan=0;
	$info=new CActiveDataProvider('Actividadesgrupo',array('criteria'=>array('condition'=>'idplan="'.$idplan.'"')));
	$dataProvider=new CActiveDataProvider('Plangrupo');
	$vacio=new CActiveDataProvider('Plangrupo',array('criteria'=>array('condition'=>'id="0"')));
	$grupo=Grupo::model()->findAll();
	if(isset($_GET['idPlan'])){
				
		$idplan=$_GET['idPlan'];
		$info=new CActiveDataProvider('Actividadesgrupo',array('criteria'=>array('condition'=>'idplan="'.$idplan.'"')));
		
	}
		if(isset($_POST['grupo'])||isset($_GET['idPlan'])){
			if(isset($_POST['grupo'])){
				$g=$_POST['grupo'];
			}
			if(isset($_GET['idPlan'])){
				$g=$_GET['grupoSel'];
			}
			$dataProvider=new CActiveDataProvider('Plangrupo',array('criteria' => array(
			'condition' =>'idgrupo=(select id from sgu_grupo where grupo="'.$g.'")')
			,'pagination'=>array('pageSize'=>9999999)));
			
			$this->render('crearPlan',array(
			'grupo'=>$grupo,
			'dataProvider'=>$dataProvider,
			'seleccion'=>$g,
			'actividades'=>$info,
			'vacio'=>$vacio,
		));
			
		}
		else{
		$this->render('crearPlan',array('criteria' => array('pagination'=>array('pageSize'=>9999999)),
			'vacio'=>$vacio,
			'grupo'=>$grupo,
			'dataProvider'=>$dataProvider,
			'actividades'=>$info
		));
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$tipo = new Tiporepuesto;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Repuesto']))
		{
			$model->attributes=$_POST['Repuesto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex(){
	
			$dataProvider=new CActiveDataProvider('Actividades',array('criteria' => array(
			'condition' =>'idplan in (select id from sgu_plan) and idestatus<>1 and idestatus<>3',
			'order'=>'proximoFecha'
			)));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Repuesto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Repuesto']))
			$model->attributes=$_GET['Repuesto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Repuesto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Repuesto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Repuesto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='repuesto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
