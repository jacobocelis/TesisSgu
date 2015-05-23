<?php

class GrupoController extends Controller
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
				'actions'=>array('index','view','Addnew'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
	'actions'=>array('create','update','nuevoGrupo','ActualizarListaGrupo','parametros','actualizar'),
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
	 public function actionAddnew($id){
                $model=new Infgrupo;
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
 
    if(isset($_POST['Infgrupo'])){
            $model->attributes=$_POST['Infgrupo'];
            if($model->save()){
			$totalVeh=Yii::app()->db->createCommand('select id from sgu_vehiculo where idgrupo="'.$id.'"')->queryAll();
			$total=count($totalVeh);
			for($i=0;$i<$total;$i++){
				Yii::app()->db->createCommand("INSERT ignore INTO `tsg`.`sgu_informacion` (`idvehiculo`,`informacion`) 
						VALUES ('".$totalVeh[$i]['id']."','".$model->informacion."')")->query();
			}
                if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se agregó el campo correctamente"
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
                'div'=>$this->renderPartial('_form2', array('model'=>$model,'id'=>$id), true)));
            exit;               
        }
        /*else
            $this->render('create',array('model'=>$model,));*/
}
	public function actionActualizar($id){
		$model=$this->loadModel($id);
		  
		if(isset($_POST['Grupo'])){
				$model->attributes=$_POST['Grupo'];
				if($model->save()){
					if (Yii::app()->request->isAjaxRequest){
						echo CJSON::encode(array(
							'status'=>'success', 
							'div'=>"se actualizó el grupo"
							));
						exit;               
					}
				}
			}
			if (Yii::app()->request->isAjaxRequest){
				echo CJSON::encode(array(
					'status'=>'failure', 
					'div'=>$this->renderPartial('_form', array('model'=>$model), true)));
				exit;               
			}
		 
	}

    public function actionParametros(){

		$gridGrupo=new CActiveDataProvider('Grupo',array('criteria' => array(
		'condition' =>"1",
		'order'=>'id')));

		$gridTipo=new CActiveDataProvider('Tipo',array('criteria' => array(
		'condition' =>"1",
		'order'=>'id')));
		
		$this->render('parametros',array(
			'gridGrupo'=>$gridGrupo,
			'gridTipo'=>$gridTipo,
		));
	}

	public function actionNuevoGrupo(){
		$model=new Grupo;
		  
		if(isset($_POST['Grupo'])){
				$model->attributes=$_POST['Grupo'];
				if($model->save()){
					if (Yii::app()->request->isAjaxRequest){
						echo CJSON::encode(array(
							'status'=>'success', 
							'div'=>"se agregó el grupo"
							));
						exit;               
					}
				}
			}
			if (Yii::app()->request->isAjaxRequest){
				echo CJSON::encode(array(
					'status'=>'failure', 
					'div'=>$this->renderPartial('_form', array('model'=>$model), true)));
				exit;               
			}
		 
	}
	public function actionActualizarListaGrupo(){
	
			$lista=Grupo::model()->findAll('1 order by id desc');
			foreach($lista as $li){
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li->id))),Chtml::encode(($li->grupo)),true);
			
		}
	}
	public function actionView($id){
	
	if(isset($_POST['Infgrupo'])){
		$inf=new Infgrupo;
		$inf->attributes=$_POST['Infgrupo'];
			$inf->save();
				//$this->redirect(array('view','id'=>$model->id));
	}
		$rawData=array(
	           array('id'=>'Número de unidad'),
	           array('id'=>'Serial de carrocería'),
			   array('id'=>'Serial de Motor'),
			   array('id'=>'Placa'),
			   array('id'=>'Año'),
			   array('id'=>'Marca'),
			   array('id'=>'Modelo'),
			   array('id'=>'Combustible'),
			   array('id'=>'Color'),
			   //array('id'=>'Número de puestos'),
			   //array('id'=>'Número de ejes'),
			   //array('id'=>'Capacidad de carga'),
			   //array('id'=>'Número de ruedas'),
			   //array('id'=>'Capacidad de tanque'),
			   array('id'=>'Propiedad'),
	       );
		$atrib=new CArrayDataProvider($rawData, array('id'=>'id','pagination'=>array(
      'pageSize'=>1000)));
		$info=new CActiveDataProvider('Infgrupo',array('criteria'=>array('condition'=>'idgrupo="'.$id.'"')));
		$info->setPagination(false);
		$dataProvider=new CActiveDataProvider('Vehiculo',array('criteria'=>array('condition'=>'idgrupo="'.$id.'"')));
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'dataProvider'=>$dataProvider,
			'info'=>$info,
			'atributos'=>$atrib
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Grupo;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Grupo']))
		{
			$model->attributes=$_POST['Grupo'];
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

		if(isset($_POST['Grupo']))
		{
			$model->attributes=$_POST['Grupo'];
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
		try{
			
			$this->loadModel($id)->delete();
				if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}catch(CDbException $e){
                   
			echo CHtml::decode(" No se pudo eliminar el grupo porque tiene información asociada");
			
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
	
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Grupo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Grupo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Grupo']))
			$model->attributes=$_GET['Grupo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Grupo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Grupo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Grupo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='grupo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	

}
