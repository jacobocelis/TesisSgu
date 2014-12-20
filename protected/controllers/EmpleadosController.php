<?php

class EmpleadosController extends Controller
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
				'actions'=>array('create','update','conductores','AgregarConductorRuta','RegistrarConductor','coordinadores','agregarCoordinador'),
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
	public function actionConductores(){
		$dataProvider=new CActiveDataProvider('Historicoempleados');
		
		$this->render('conductores',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function actionCoordinadores(){
		$dataProvider=new CActiveDataProvider('Empleado',array('criteria'=>array('condition'=>'idtipoEmpleado>1')));
		
		$this->render('coordinadores',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionRegistrarConductor(){
			$id='id=1';
		$model=new Empleado;
		if(isset($_POST['Empleado'])){
            $model->attributes=$_POST['Empleado'];
			if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Conductor agregado"
                        ));
					exit;
                }
            }
        }
		 if (Yii::app()->request->isAjaxRequest){	
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formEmpleado', array('model'=>$model,'tipo'=>$id), true)
				));
            exit;               
        }
	}
	public function actionAgregarCoordinador(){
			$id='id>1';
	
		$model=new Empleado;
		if(isset($_POST['Empleado'])){
            $model->attributes=$_POST['Empleado'];
			if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Conductor agregado"
                        ));
					exit;
                }
            }
        }
		 if (Yii::app()->request->isAjaxRequest){	
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formCoordinador', array('model'=>$model,'tipo'=>$id), true)
				));
            exit;               
        }
	}
	public function actionAgregarConductorRuta(){
                $model=new Historicoempleados;
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
			
		if(isset($_POST['Historicoempleados'])){
            $model->attributes=$_POST['Historicoempleados'];
            if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se asoció el coductor a la unidad correctamente"
                        ));
                    exit;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formConductor', array('model'=>$model), true)));
            exit;               
        }
        /*else
            $this->render('create',array('model'=>$model,));*/
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Historicoempleados;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Historicoempleados']))
		{
			$model->attributes=$_POST['Historicoempleados'];
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

		if(isset($_POST['Historicoempleados']))
		{
			$model->attributes=$_POST['Historicoempleados'];
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
		$dataProvider=new CActiveDataProvider('Historicoempleados');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Historicoempleados('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Historicoempleados']))
			$model->attributes=$_GET['Historicoempleados'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Historicoempleados the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Historicoempleados::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Historicoempleados $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='historicoempleados-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}