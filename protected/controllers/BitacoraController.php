<?php

class BitacoraController extends Controller
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
				'actions'=>array('index','view'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Bitacora;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bitacora']))
		{
			$model->attributes=$_POST['Bitacora'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bitacora']))
		{
			$model->attributes=$_POST['Bitacora'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Bitacora',array('criteria' => array(
			'condition' =>'1',
			'order'=>'id')));
			
			if(isset($_GET["fechaIni"]) or isset($_GET["fechaFin"]) or isset($_GET["vehiculo"])){
				if($_GET["fechaIni"]=="" and $_GET["fechaFin"]=="" and $_GET["vehiculo"]==""){
					$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
						'condition' =>'idestatus=7 and tipo=1',
						'order'=>'fecha')));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]==""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
						'condition' =>'idestatus=7 and tipo=1 and (fecha>="'.$fechaini.'" and fecha<="'.$fechafin.'")',
						'order'=>'fecha',
					)));		
				}
				if($_GET["fechaIni"]=="" and $_GET["vehiculo"]!=""){
					
					$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
						'condition' =>'idestatus=7 and tipo=1 and id in (select idordenMtto from sgu_detalleOrdenCo where idreporteFalla in (select id from sgu_reporteFalla where idvehiculo='.$_GET["vehiculo"].'))',
						'order'=>'fecha',
					)));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]!=""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
						'condition' =>'idestatus=7 and tipo=1 and (fecha>="'.$fechaini.'" and fecha<="'.$fechafin.'") and id in (select idordenMtto from sgu_detalleOrdenCo where idreporteFalla in (select id from sgu_reporteFalla where idvehiculo='.$_GET["vehiculo"].'))',
						'order'=>'fecha',
					)));	
				}
			}
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Bitacora('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Bitacora']))
			$model->attributes=$_GET['Bitacora'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Bitacora the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Bitacora::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Bitacora $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bitacora-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
