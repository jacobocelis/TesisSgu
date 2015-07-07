<?php

class FeriadoController extends Controller
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
				'actions'=>array('create','update','agregar','actualizar'),
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
		$model=new Feriado;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Feriado']))
		{
			$model->attributes=$_POST['Feriado'];
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
	public function actionAgregar(){
		$model=new Feriado;
		if(isset($_POST['Feriado'])){

            $model->attributes=$_POST['Feriado'];		
        if($_POST['Feriado']['fechaInicio']<>"")
        	$model->fechaInicio=date("Y-m-d", strtotime(str_replace('/', '-', $_POST['Feriado']['fechaInicio'])));
		if($_POST['Feriado']['fechaFin']<>"")
			$model->fechaFin=date("Y-m-d", strtotime(str_replace('/', '-', $_POST['Feriado']['fechaFin'])));
		
            if($model->save()){
            	$actividades = Actividades::model()->findAll("idestatus=2");
            	foreach ($actividades as $value) {
            		if($value->proximoFecha>=$model->fechaInicio and $value->proximoFecha<=$model->fechaFin){
            			$actualizar=Actividades::model()->findByPk($value->id);
            			$actController= new ActividadesController("actividades");
            			while($actController->esFeriado($value->proximoFecha)){
                    		$value->proximoFecha=date("Y-m-d",strtotime($value->proximoFecha . "+1 day"));
                    	}
                    	$actualizar->proximoFecha=$value->proximoFecha;
                    	$actualizar->update();
            		}
            	}
                if (Yii::app()->request->isAjaxRequest){
				  
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Destino agregado",
                        'mensaje'=>'<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
                            <b>El viaje se registró correctamente</b>
                        	</div>'
                        ));
					exit;
                }
            }
        }
		 if (Yii::app()->request->isAjaxRequest){	
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_form', array('model'=>$model), true, true)
				));
            exit;               
        }
	}
	public function actionActualizar($id){
		$model=$this->loadModel($id);
		  
		if(isset($_POST['Feriado'])){
				$model->attributes=$_POST['Feriado'];
				if($model->save()){
					if (Yii::app()->request->isAjaxRequest){
						echo CJSON::encode(array(
							'status'=>'success', 
							'div'=>"se actualizó la fecha"
							));
						exit;               
					}
				}
			}
			if (Yii::app()->request->isAjaxRequest){
				echo CJSON::encode(array(
					'status'=>'failure', 
					'div'=>$this->renderPartial('_formLugar', array('model'=>$model), true)));
				exit;               
			}
	}
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Feriado']))
		{
			$model->attributes=$_POST['Feriado'];
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
		$dataProvider=new CActiveDataProvider('Feriado');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Feriado('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Feriado']))
			$model->attributes=$_GET['Feriado'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Feriado the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Feriado::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Feriado $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='feriado-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
