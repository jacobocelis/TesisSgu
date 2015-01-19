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
				'actions'=>array('create','update','plantilla','ActualizarListaPlantillas','MostrarLinkEje','actualizarListaPosicionesEje','MostrarLinkCaucho','actualizarEstado','MostrarLinkRep','MostrarDivRep','TieneGrupo','montajeInicial','montar','alertaCambioCauchos','ActualizarSpan','averiaNeumatico','RegistrarAveriaNeumatico','AgregarAveriaNueva','ajaxActualizarAverias'),
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
	public function actionAgregarAveriaNueva(){
		$model=new Fallacaucho;
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
 
    if(isset($_POST['Fallacaucho'])){
            $model->attributes=$_POST['Fallacaucho'];
            if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
				   /*inserts por debajo del plan de mantenimiento a cada vehiculo del grupo*/
				   
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se agregó la avería correctamente"
                        ));
                    exit;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formNuevaAveria', array('model'=>$model), true)));
            exit;               
        }
	}
	/*public function actionRegistrarAveriaNeumatico(){
		$model=new Detalleeventoca;
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
		 $idv=0;
		 
		$montados=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv." and idestatusCaucho=1"),'pagination' => false));
    if(isset($_POST['Detalleeventoca'])){
            $model->attributes=$_POST['Detalleeventoca'];
			$model->fechaFalla=date("Y-m-d", strtotime(str_replace('/', '-',$model->fechaFalla )));
            if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
				   
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se agregó la avería correctamente"
                        ));
                    exit;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formAveria', array('model'=>$model,'montados'=>$montados), true)));
            exit;               
        }
		
	}*/
	public function actionAveriaNeumatico(){
		
		$model=new Detalleeventoca;
		$dataProvider=new CActiveDataProvider('Detalleeventoca',array('criteria' => array(
			'condition' =>'idestatus=8',
			//'order'=>'fechaFalla DESC'
			),
			'sort'=>array(
				'defaultOrder'=>'id DESC',
			),
			'pagination'=>array(
			'pageSize'=>5,
			)
	));
			$idv=0;
			if(isset($_GET["idvehiculo"])){
				if($_GET["idvehiculo"]=="")
					$idv=0;
				else
					$idv=$_GET["idvehiculo"];
			}	
		$montados=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv." and idestatusCaucho=1"),'pagination' => false));
		$reg=0;
		if(isset($_POST['Detalleeventoca'])){	
			$model->attributes=$_POST['Detalleeventoca'];
			$model->fechaFalla=date("Y-m-d", strtotime(str_replace('/', '-', $_POST['Detalleeventoca']['fechaFalla'])));
			if($model->save()){
				$model->unsetAttributes();
				$reg=1;
				$this->render('averiaNeumatico',array(
					'dataProvider'=>$dataProvider,
					'montados'=>$montados,
					'model'=>$model,
					'registrado'=>$reg
				));
			}else
				$this->render('averiaNeumatico',array(
					'dataProvider'=>$dataProvider,
					'montados'=>$montados,
					'model'=>$model,
					'registrado'=>$reg
				));	
		}
		else{
			$this->render('averiaNeumatico',array(
				'dataProvider'=>$dataProvider,
				'montados'=>$montados,
				'model'=>$model,
				'registrado'=>$reg
			));
		}
	}
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
		
		$ejes=new CActiveDataProvider("Detalleeje",array("criteria"=>array("condition"=>"idchasis=".$idChasis."")));
		
		$ruedas=new CActiveDataProvider('Detallerueda',array("criteria"=>array("condition"=>"iddetalleEje=".$idEje."")));
		
		$rep=new CActiveDataProvider('Cauchorep',array("criteria"=>array("condition"=>"idchasis=".$idChasis."")));
		
		$grup=new CActiveDataProvider('Asigchasis',array("criteria"=>array("condition"=>"idchasis=".$idChasis."")));
		
		$todo=new CActiveDataProvider('Asigchasis',array("criteria"=>array("condition"=>"1")));
		$this->render('plantilla',array(
			'chasis'=>$chasis,
			'llantas'=>$ejes,
			'ruedas'=>$ruedas,
			'rep'=>$rep,
			'ca'=>$ca,
			'grup'=>$grup,
			'todo'=>$todo,	
			'iniciales'=>$this->getPorDefinir()
			
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
		$idv=1;
		$montados=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv." and idestatusCaucho=1"),'pagination' => false));
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
			'montados'=>$montados
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
	public function actionMontar($id){
		
		$model=$this->loadModel($id);

		if(isset($_POST['Historicocaucho'])){
			 $model->attributes=$_POST['Historicocaucho'];
			 $model->fecha=date("Y-m-d", strtotime(str_replace('/', '-',$model->fecha)));
			if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Montaje realizado",
						'ui'=>$model->idvehiculo,
                        ));
					exit;
                }
            }
		}
			if (Yii::app()->request->isAjaxRequest){	
				if($model->iddetalleRueda=="")
					$model->idestatusCaucho=4;
				else
					$model->idestatusCaucho=1;
			
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formMD', array('model'=>$model), true),
				'ui'=>$model->idvehiculo,
				));
            exit;               
        }
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
		$montados=array();
		$rep=array();
		$veh=array();
		$idveh=Vehiculo::model()->findAll();
		$reposicionDias=Parametro::model()->findByAttributes(array('nombre'=>'alertaCambioCauchos'));
		
		if(isset($_POST["Vehiculo"])){
			if($_POST["Vehiculo"]["id"]==""){
				foreach($idveh as $idv){
					$montados[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idestatusCaucho=1 and idvehiculo=".$idv["id"]."")));
					$rep[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idestatusCaucho=4 and idvehiculo=".$idv["id"]."")));
					$veh[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv["id"]."","limit"=>"1"),'pagination' => false));
				}
			}else{
				$montados[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idestatusCaucho=1 and idvehiculo=".$_POST["Vehiculo"]["id"]."")));
				$rep[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idestatusCaucho=4 and idvehiculo=".$_POST["Vehiculo"]["id"]."")));
			$veh[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$_POST["Vehiculo"]["id"]."","limit"=>"1"),'pagination' => false));
			
			}
		
		}else
			foreach($idveh as $idv){
				
			$montados[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idestatusCaucho=1 and idvehiculo=".$idv["id"]."")));
			$rep[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idestatusCaucho=4 and idvehiculo=".$idv["id"]."")));
		    $veh[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv["id"]."","limit"=>"1"),'pagination' => false));
		}
			
		$this->render('index',array(
			'montados'=>$montados,
			'rep'=>$rep,
			'veh'=>$veh,
			'iniciales'=>$this->getPorDefinir(),
			'reposicionDias'=>$reposicionDias["valor"],
			
		));
	}
public function actionMontajeInicial(){
		$montados=array();
		$rep=array();
		$veh=array();
		$idveh=Vehiculo::model()->findAll();
		
		if(isset($_POST["Vehiculo"])){
			if($_POST["Vehiculo"]["id"]==""){
				foreach($idveh as $idv){
					$montados[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"(idestatusCaucho=5 or idestatusCaucho=1) and idvehiculo=".$idv["id"]."")));
					$rep[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"(idestatusCaucho=6 or idestatusCaucho=4) and idvehiculo=".$idv["id"]."")));
					$veh[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv["id"]."","limit"=>"1"),'pagination' => false));
				}
			}else{
				$montados[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"(idestatusCaucho=5 or idestatusCaucho=1) and idvehiculo=".$_POST["Vehiculo"]["id"]."")));
				$rep[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"(idestatusCaucho=6 or idestatusCaucho=4) and idvehiculo=".$_POST["Vehiculo"]["id"]."")));
				$veh[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$_POST["Vehiculo"]["id"]."","limit"=>"1"),'pagination' => false));
			}
		}else
			foreach($idveh as $idv){
				$montados[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"(idestatusCaucho=5 or idestatusCaucho=1) and idvehiculo=".$idv["id"]."")));
				$rep[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"(idestatusCaucho=6 or idestatusCaucho=4) and idvehiculo=".$idv["id"]."")));
				$veh[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv["id"]."","limit"=>"1"),'pagination' => false));
		}
		$this->render('montajeInicial',array(
			'montados'=>$montados,
			'rep'=>$rep,
			'veh'=>$veh
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
	 public function getPorDefinir(){
		$tot=Yii::app()->db->createCommand("select count(*) as total from sgu_historicoCaucho where idestatusCaucho=5 or idestatusCaucho=6")->queryRow();
		return $tot["total"];
	}
	
	public function Color($id){
		if($id>0)
			return "important";
		else	
			return "";
	}
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
	public function actionMostrarDivRep($id){
		if($id==0){
			echo 0;
			return 0;
		}
		$chasis=Chasis::model()->findByPk($id);
		if($chasis->cantidadRepuesto==0)
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
	public function actionTieneGrupo(){
		/*if($id==0){
			echo 2;
			return 0;
		}
		$gru=new CActiveDataProvider("Asigchasis",array("criteria"=>array("condition"=>"idchasis=".$id."")));
		$totalRuedas=$gru->getTotalItemCount();
		
		if($totalRuedas>0)
			echo 0;
		else
			echo 1;*/
		
			$lista2=Grupo::model()->findAll('id not in (select idgrupo from sgu_asigChasis)');
			echo CHtml::tag('option',array('type'=>'text','value'=>""),Chtml::encode("Seleccione: "),true);
			foreach($lista2 as $li){
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li->id))),Chtml::encode(($li->grupo)),true);
			}
		
	}
	public function actionMostrarLinkRep($id){
		if($id==0){
			echo 1;
			return 0;
		}
		
		$rep=new CActiveDataProvider("Cauchorep",array("criteria"=>array("condition"=>"idchasis=".$id."")));
		$total=$rep->getTotalItemCount();
		if($total<1)
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
	
	public function actionActualizarEstado($id){
		if($id==0){
			echo -1;
			return 0;
		}			
			$ruedasTiene=Yii::app()->db->createCommand("select count(*) as total from sgu_chasis c, sgu_detalleEje de, sgu_detalleRueda dr where c.id=de.idchasis and de.id=dr.iddetalleEje and c.id=".$id."")->queryRow();
			$rTiene=$ruedasTiene["total"];
			$rep=Yii::app()->db->createCommand("select count(*) as total from sgu_cauchoRep cr, sgu_chasis c where c.id=cr.idchasis and c.id=".$id."")->queryRow();
			$cant=Chasis::model()->findByPk($id);
			$ruedasDebe=$cant->cantidadNormales;
			if($cant->cantidadRepuesto>0)
				$ruedasDebe=$ruedasDebe+1;
			$rTiene=$rTiene+$rep["total"];
			
		if($rTiene==$ruedasDebe)
			echo 1;
		if($rTiene>$ruedasDebe)
			echo 2;
		if($rTiene<$ruedasDebe)
			echo 0;
	
	}
	public function actionalertaCambioCauchos($id){
		$modelo=Parametro::model()->findByAttributes(array('nombre'=>'alertaCambioCauchos'));
		$modelo->valor=$id;
		$modelo->save();
	}
	public function actionActualizarSpan(){
		$mi=Yii::app()->db->createCommand("select count(*) as total from sgu_historicoCaucho where idestatusCaucho=5 or idestatusCaucho=6")->queryRow();
		
		echo CJSON::encode(array(
			'total'=>$mi["total"],
			'color'=>$this->Color($mi["total"]),
		));
	}
	public function actionAjaxActualizarAverias(){
		
		$models = Fallacaucho::model()->findAll('id<>0 order by id DESC');
		foreach ($models as $mode){
			echo CHtml::tag('option',array('type'=>'text','value'=>(($mode->id))),Chtml::encode(($mode->falla)),true);
		}
	}
}
