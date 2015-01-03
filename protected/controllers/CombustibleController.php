<?php

class CombustibleController extends Controller
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
				'actions'=>array('create','update','alertaReposicion','autonomia','formAutonomia','registrarReposicion','RegReposicion','AjaxObtenerTipoCombustible','CostoCombustible'),
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
	public function actionRegistrarReposicion(){
		$dataProvider=new CActiveDataProvider('Historicocombustible',array('criteria'=>array('condition'=>'1','order'=>'id desc')));
		$dataProvider->setPagination(false);
		
		$this->render('registrarReposicion',array(
			'dataProvider'=>$dataProvider
		));
	}
	public function actionRegReposicion(){
		
		$model=new Historicocombustible;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Historicocombustible']))
		{
			$model->attributes=$_POST['Historicocombustible'];
			if($model->validate()){
				$model->fecha=date("Y-m-d", strtotime(str_replace('/', '-',$model->fecha)));
				$consulta=Yii::app()->db->createCommand("select id,fecha from sgu_historicoCombustible where idvehiculo=".$model->idvehiculo." order by fecha desc limit 1")->queryAll();
				if(count($consulta)>0){
					if($consulta[0]["fecha"]>$model->fecha)
						$model->historico=1;
					else
					Yii::app()->db->createCommand("update `tsg`.`sgu_historicoCombustible` set `historico` = 1 where `sgu_historicoCombustible`.`id` = ".$consulta[0]["id"]."")->query();	
				}
			}
			if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
				   /*inserts por debajo del plan de mantenimiento a cada vehiculo del grupo*/
				   
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se realizó el registro correctamente",
                        ));
                    exit;
                }
            }	
		}
		if (Yii::app()->request->isAjaxRequest){
				echo CJSON::encode(array(
					'status'=>'failure', 
					'div'=>$this->renderPartial('_formReposicion', array('model'=>$model), true)));
				exit;               
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Historicocombustible']))
		{
			$model->attributes=$_POST['Historicocombustible'];
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
		$reposicionDias=Parametro::model()->findByAttributes(array('nombre'=>'alertaReposicion'));
		$consulta=Yii::app()->db->createCommand("select * from(select * from sgu_historicocombustible  order by fecha desc) historicocombustible  group by idvehiculo")->queryAll();
		//file_put_contents('prueba.txt',print_r($model=new Historicocombustible,true));
		//$dataProvider=new CArrayDataProvider($consulta, array('keyField'=>'id'));
		//,array('criteria'=>array('group'=>'t.idvehiculo','order'=>'fecha desc'))
        $dataProvider=new CActiveDataProvider('Historicocombustible',array('criteria'=>array('condition'=>'historico=0','order'=>'fecha desc')));
		$dataProvider->setPagination(false);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'reposicionDias'=>$reposicionDias["valor"],
		));
	}
	public function actionFormAutonomia($id){
		//se envia desde la vista mail
			$model = new Autonomia;
		if(isset($_POST['Autonomia'])){
				$model->attributes=$_POST['Autonomia'];
				if($model->validate()){	
					$vehiculos=Vehiculo::model()->findAll('idgrupo='.$id);
					foreach($vehiculos as $veh){
						$veh->rendimiento=$model->autonomia;
						$veh->save();
					}
					if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Información actualizada"
                        ));
					exit;
                }
				}
				
		}
			if (Yii::app()->request->isAjaxRequest){	
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formAutonomia', array('model'=>$model), true)
				));
            exit;               
        }
	}
	public function actionAutonomia()
	{	$idgrupo=0;
		if(isset($_GET["idGrupo"])){
			$idgrupo=$_GET["idGrupo"];
		}
		
		$vehiculos=new CActiveDataProvider('Vehiculo',array('criteria'=>array('condition'=>'idgrupo='.$idgrupo)));
		$grupo=Grupo::model()->findAll();
		$dataProvider=new CActiveDataProvider('Historicocombustible',array('criteria'=>array('order'=>'fecha desc')));
		$this->render('autonomia',array(
			'dataProvider'=>$dataProvider,
			'grupo'=>$grupo,		
			'vehiculos'=>$vehiculos,
			
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Historicocombustible('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Historicocombustible']))
			$model->attributes=$_GET['Historicocombustible'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Historicocombustible the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Historicocombustible::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Historicocombustible $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='historicocombustible-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionalertaReposicion($id){
		$modelo=Parametro::model()->findByAttributes(array('nombre'=>'alertaReposicion'));
		$modelo->valor=$id;
		$modelo->save();
	}
	public function actionAjaxObtenerTipoCombustible($id){
			if($id==0)
				return  CHtml::tag('option',array('type'=>'text','value'=>((''))),Chtml::encode(('')),true);
	$model=Vehiculo::model()->findByPk($id);
			$idtipo=$model->idcombustible;
	$models = Combust::model()->findAll('idtipoCombustible = '.$idtipo.' order by id DESC');
		foreach ($models as $mode){
			echo CHtml::tag('option',array('type'=>'text','value'=>(($mode->id))),Chtml::encode(($mode->tipo)),true);
		}
	}
	
	public function actionCostoCombustible($id){
			$model=Combust::model()->findByPk($id);
			echo $model->costoLitro;
	}
}