<?php

class ActividadesgrupoController extends Controller
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
		$model=new Actividadesgrupo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Actividadesgrupo']))
		{
			$model->attributes=$_POST['Actividadesgrupo'];
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
/*
		if(isset($_POST['Actividadesgrupo']))
		{
			$model->attributes=$_POST['Actividadesgrupo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));*/
		if(isset($_POST['Actividadesgrupo'])){
            $model->attributes=$_POST['Actividadesgrupo'];
            if($model->save()){
				/*Registro en la bitácora*/
				Bitacora::registrarEvento(Yii::app()->user->id,'INSERT','sgu_actividadesGrupo');
                if (Yii::app()->request->isAjaxRequest){
				/*actualizacion por debajo a tabla actividades*/
				//$modelo=Plangrupo::model()->findByPk($id);
				//$totalVeh=Yii::app()->db->createCommand('select id from sgu_actividades where idactividadesGrupo ="'.$id.'"')->queryAll();
				//$total=count($totalVeh);
				
				//for($i=0;$i<$total;$i++){
					Yii::app()->db->createCommand('UPDATE `tsg`.`sgu_actividades` SET `idactividadMtto` = "'.$model->idactividadMtto.'", `frecuenciaKm` = "'.$model->frecuenciaKm.'", `frecuenciaMes` = "'.$model->frecuenciaMes.'", `duracion` = "'.$model->duracion.'", `idprioridad` = "'.$model->idprioridad.'", `idtiempod` = "'.$model->idtiempod.'", `idtiempof` = "'.$model->idtiempof.'", `procedimiento` = "'.$model->procedimiento.'"  WHERE `sgu_actividades`.`idactividadesGrupo` = '.$id)->query();
					/*Registro en la bitácora*/
					Bitacora::registrarEvento(Yii::app()->user->id,'UPDATE','sgu_actividades');
				//}
					/*-----------------------------------------------------------------------------------------------*/
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se editó el campo correctamente"
                        ));
                    exit;               
                }
                /*else
                    $this->redirect(array('view','id'=>$model->id));*/
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_form', array('model'=>$model,'id'=>$id), true)));
            exit;               
        }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id){
		/*aqui elimino por debajo*/
		Yii::app()->db->createCommand("DELETE FROM `tsg`.`sgu_actividades` WHERE `sgu_actividades`.`idactividadesGrupo` = '".$id."'")->query();
		/*Registro en la bitácora*/
		Bitacora::registrarEvento(Yii::app()->user->id,'DELETE','sgu_actividades');
		$this->loadModel($id)->delete();
		/*Registro en la bitácora*/
		Bitacora::registrarEvento(Yii::app()->user->id,'DELETE','sgu_actividadesGrupo');
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Actividadesgrupo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Actividadesgrupo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Actividadesgrupo']))
			$model->attributes=$_GET['Actividadesgrupo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Actividadesgrupo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Actividadesgrupo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Actividadesgrupo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='actividadesgrupo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
