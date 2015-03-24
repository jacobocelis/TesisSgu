<?php

class ActividadrecursoController extends Controller
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
		$model=new Actividadrecurso;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Actividadrecurso']))
		{
			$model->attributes=$_POST['Actividadrecurso'];
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

		/*if(isset($_POST['Actividadrecurso']))
		{
			$model->attributes=$_POST['Actividadrecurso'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));*/
		if(isset($_POST['Actividadrecurso'])){
            $model->attributes=$_POST['Actividadrecurso'];
            if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
					if(isset($_POST['idfac'])){
						
						$iva=Parametro::model()->findByAttributes(array('nombre'=>'IVA'));
						$factura=Factura::model()->findByPk($_POST['idfac']);
						$actividades=Detalleorden::model()->findAll(array("condition"=>"idordenMtto = '".$factura->idordenMtto."'"));
						$subTotal=0;
						for($i=0;$i<count($actividades);$i++){
							$recursos=Actividadrecurso::model()->findAll(array("condition"=>"idactividades = '".$actividades[$i]["idactividades"]."'"));
							for($j=0;$j<count($recursos);$j++){
								$subTotal+=$recursos[$j]["costoTotal"];
							}
						}
						Yii::app()->db->createCommand("update `tsg`.`sgu_factura` set `total`=".$subTotal." where `sgu_factura`.`id` = ".$_POST['idfac']."")->query();
						$factura=Factura::model()->findByPk($_POST['idfac']);
						Yii::app()->db->createCommand("update `tsg`.`sgu_factura` set `iva`=".(($factura->total)*($iva["valor"]/100)).",`totalFactura`=".(($factura->total)+($factura->total)*($iva["valor"]/100))."   where `sgu_factura`.`id` = ".$_POST['idfac']."")->query();
					}
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se agregó el costo correctamente"
                        ));
                    exit;               
                }
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
	public function actionDelete($id,$idfac)
	{	
		$this->loadModel($id)->delete();
		
		if(isset($idfac)){
						$iva=Parametro::model()->findByAttributes(array('nombre'=>'IVA'));
						$factura=Factura::model()->findByPk($idfac);
						$actividades=Detalleorden::model()->findAll(array("condition"=>"idordenMtto = '".$factura->idordenMtto."'"));
						$subTotal=0;
						for($i=0;$i<count($actividades);$i++){
							$recursos=Actividadrecurso::model()->findAll(array("condition"=>"idactividades = '".$actividades[$i]["idactividades"]."'"));
							for($j=0;$j<count($recursos);$j++){
								$subTotal+=$recursos[$j]["costoTotal"];
							}
						}
						Yii::app()->db->createCommand("update `tsg`.`sgu_factura` set `total`=".$subTotal." where `sgu_factura`.`id` = ".$idfac."")->query();
						$factura=Factura::model()->findByPk($idfac);
						Yii::app()->db->createCommand("update `tsg`.`sgu_factura` set `iva`=".(($factura->total)*($iva["valor"]/100)).",`totalFactura`=".(($factura->total)+($factura->total)*($iva["valor"]/100))."   where `sgu_factura`.`id` = ".$idfac."")->query();
		}
					
		

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Actividadrecurso');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Actividadrecurso('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Actividadrecurso']))
			$model->attributes=$_GET['Actividadrecurso'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Actividadrecurso the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Actividadrecurso::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Actividadrecurso $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='actividadrecurso-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
