<?php

class ActividadesController extends Controller
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
		$model=new Actividades;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Actividades']))
		{
			$model->attributes=$_POST['Actividades'];
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
	public function actionUpdate($id,$idestatus){
	
		$model=$this->loadModel($id);
		if($model->ultimoKm==-1 or $model->ultimoFecha=='0000-01-01')
			$var=1;
		else
			$var=0;
			if(isset($_POST['Actividades'])){
            $model->attributes=$_POST['Actividades'];
            if($model->save()){
			//calculo del proximo mantenimiento a realizarse en base al ultimo ingresado
				$proximoFecha = new DateTime($model->ultimoFecha);
				$proximoKm=$model->ultimoKm+$model->frecuenciaKm;
				$proximoFecha->add(new DateInterval('P'.$model->frecuenciaMes.$model->idtiempof0->sqlTimevalues));
				file_put_contents('prueba.txt', print_r($proximoFecha,true));
				
				Yii::app()->db->createCommand("update `tsg`.`sgu_actividades` set proximoKm='".$proximoKm."', proximoFecha='".$proximoFecha->format("Y-m-d")."', idestatus='".$model->idestatus."'
				where id = '".$id."'")->query();
				
                if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se registró el mantenimiento correctamente"
                        ));
                    exit;               
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formRegistrarMi', array('model'=>$model,'id'=>$var,'idestatus'=>$idestatus), true)));
            exit;               
        }
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Actividades']))
		{
			$model->attributes=$_POST['Actividades'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
		/*public function actionUpdate($id,$idestatus){
		
		$model=$this->loadModel($id);
		if($model->ultimoKm==-1 or $model->ultimoFecha=='0000-01-01')
			$var=1;
		else
			$var=0;
			if(isset($_POST['Actividades'])){
            $model->attributes=$_POST['Actividades'];
            if($model->save()){
			//calculo del proximo mantenimiento a realizarse en base al ultimo ingresado
				$proximoFecha = new DateTime($model->ultimoFecha);
				$proximoKm=$model->ultimoKm+$model->frecuenciaKm;
				$proximoFecha->add(new DateInterval('P'.$model->frecuenciaMes.$model->idtiempof0->sqlTimevalues));
				//file_put_contents('prueba.txt', print_r($proximoFecha,true));
				
				Yii::app()->db->createCommand("update `tsg`.`sgu_actividades` set proximoKm='".$proximoKm."', proximoFecha='".$proximoFecha."', idestatus='".$model->idestatus."'
				where id = '".$id."'")->query();
			}
		}
		$this->render('update',array(
			'model'=>$model,
		));
		
		}*/
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
		$dataProvider=new CActiveDataProvider('Actividades');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Actividades('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Actividades']))
			$model->attributes=$_GET['Actividades'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Actividades the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Actividades::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Actividades $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='actividades-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
