<?php

class NeumaticosController extends Controller
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
				'actions'=>array('create','update','plantilla','ActualizarListaPlantillas','MostrarLinkEje','actualizarListaPosicionesEje','MostrarLinkCaucho'),
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
	public function actionPlantilla(){
		$ca=0;
		$idChasis=0;
		$ruedas=0;
		$idEje=0;
		
		if(isset($_GET["data"])){
			if($_GET["data"]=="")
				$_GET["data"]=0;
				$idChasis=$_GET["data"];
				$ca=$_GET["data"];
		}
		
		if(isset($_GET["idEje"])){
			if($_GET["idEje"]=="")
				$_GET["idEje"]=0;
			
			$idEje=$_GET["idEje"];
		}
		$chasis=new CActiveDataProvider('Chasis',array("criteria"=>array("condition"=>"id=".$idChasis."")));
		
		/*$consulta=Yii::app()->db->createCommand("select de.nombre as Eje,  pe.posicionEje as 'Posición del eje', de.nroRuedas as 'Ruedas por eje'
		from sgu_detalleeje de, sgu_posicioneje pe  where de.idposicionEje=pe.id and de.idchasis=".$idChasis." order by de.nombre")->queryAll();*/
		//$ejes=new CArrayDataProvider($consulta, array('keyField'=>'Eje'));
		
		$ejes=new CActiveDataProvider("Detalleeje",array("criteria"=>array("condition"=>"idchasis=".$idChasis."")));
		
		$ruedas=new CActiveDataProvider('Detallerueda',array("criteria"=>array("condition"=>"iddetalleEje=".$idEje."")));
		$this->render('plantilla',array(
			'chasis'=>$chasis,
			'llantas'=>$ejes,
			'ruedas'=>$ruedas,
			'ca'=>$ca,
		));
	}
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
		$model=new Historicocaucho;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Historicocaucho']))
		{
			$model->attributes=$_POST['Historicocaucho'];
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

		if(isset($_POST['Historicocaucho']))
		{
			$model->attributes=$_POST['Historicocaucho'];
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
		$dataProvider=new CActiveDataProvider('Historicocaucho');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Historicocaucho('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Historicocaucho']))
			$model->attributes=$_GET['Historicocaucho'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Historicocaucho the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Historicocaucho::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Historicocaucho $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='historicocaucho-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionActualizarListaPlantillas(){
		
		$models = Chasis::model()->findAll('1 order by id DESC');
		foreach ($models as $mode){
			echo CHtml::tag('option',array('type'=>'text','value'=>(($mode->id))),Chtml::encode(($mode->nombre)),true);
		}
	}
	public function actionMostrarLinkEje($id){
		if($id==0){
			echo 1;
			return 0;
		}
	
		$chasis=Chasis::model()->findByPk($id);
		$ejes=new CActiveDataProvider("Detalleeje",array("criteria"=>array("condition"=>"idchasis=".$id."")));
		$totalEjes=$ejes->getTotalItemCount();
		if($totalEjes<$chasis->nroEjes)
			echo 0;
		else
			echo 1;
	}
	public function actionMostrarLinkCaucho($id){
		if($id==0){
			echo 1;
			return 0;
		}
		$eje=Detalleeje::model()->findByPk($id);
		$ruedas=new CActiveDataProvider("Detallerueda",array("criteria"=>array("condition"=>"iddetalleEje=".$id."")));
		$totalRuedas=$ruedas->getTotalItemCount();
		if($totalRuedas<$eje->nroRuedas)
			echo 0;
		else
			echo 1;
	}
	public function actionActualizarListaPosicionesEje(){
	
			$lista2=Posicioneje::model()->findAll('1 order by id desc');
			foreach($lista2 as $li){
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li->id))),Chtml::encode(($li->posicionEje)),true);
			
		}
	}
}
