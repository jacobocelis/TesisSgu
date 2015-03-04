<?php

class ViajesController extends Controller
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
				'actions'=>array('create','update','agregarViajeRutinario','agregarViajeEspecial','rutinarios','ultimosViajes','especiales','formAgregarEspecial','agregarRutaNueva','actualizarSpan','validarRuta','puestos','insumos','repuesto','validarRutaNormal','actualizarListaConductor','historicoRutinarios','historicoEspeciales'),
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
public function actionActualizarSpan(){
		$tot=Yii::app()->db->createCommand("select count(*) as total from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and v.idtipo=1 and fecha<>date(now())")->queryRow();
		echo CJSON::encode(array(
			'total'=>$tot["total"],
		));
	 }
	public function actionAgregarRutaNueva($id){
		if($id==0)
			$id='id=1';
		else
			$id='id=2 or id=3';
		$model=new Viaje;
		if(isset($_POST['Viaje'])){
            $model->attributes=$_POST['Viaje'];
			if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Viaje especial agregado"
                        ));
					exit;
                }
            }
        }
		 if (Yii::app()->request->isAjaxRequest){	
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formViaje', array('model'=>$model,'tipo'=>$id), true)
				));
            exit;               
        }
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	 
	 public function actionFormAgregarEspecial(){
		$model=new Historicoviajes;
		if(isset($_POST['Historicoviajes'])){
            $model->attributes=$_POST['Historicoviajes'];
			if($model->validate()){
				$model->fecha=date("Y-m-d", strtotime(str_replace('/', '-', $_POST['Historicoviajes']['fecha'])));
				if($_POST['Historicoviajes']['horaSalida']<>'')
					$model->horaSalida=date("H:i", strtotime($_POST['Historicoviajes']['horaSalida']));
				if(isset($_POST['Historicoviajes']['horaLlegada'])<>'')
				$model->horaLlegada=date("H:i", strtotime($_POST['Historicoviajes']['horaLlegada']));
			}
			if($model->save()){	
				$ultimaLectura=Yii::app()->db->createCommand('select lectura from sgu_kilometraje where idvehiculo='.$model->idvehiculo.' order by id desc limit 1')->queryRow();
				$kmViaje=Yii::app()->db->createCommand('select distanciaKm from sgu_viaje where id='.$model->idviaje.'')->queryRow();
				Yii::app()->db->createCommand('INSERT INTO `tsg`.`sgu_kilometraje` (`fecha`,`lectura`,`idvehiculo`) 
				VALUES ("'.date('Y-m-d').'",'.($ultimaLectura['lectura']+$kmViaje['distanciaKm']).','.$model->idvehiculo.')')->query();
			
                if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Viaje especial agregado"
                        ));
					exit;
                }
            }
        }
		 if (Yii::app()->request->isAjaxRequest){	
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formViajeEspecial', array('model'=>$model), true)
				));
            exit;               
        }
	}
	
	public function actionAgregarViajeRutinario(){
		
         $model=new Historicoviajes;
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
			if(isset($_POST['fecha']))
				$fecha=date('Y-m-d',strtotime(str_replace('/', '-', $_POST['fecha'])));
			else
				$fecha='';
				
		if(isset($_POST['Historicoviajes'])){
            $model->attributes=$_POST['Historicoviajes'];
			if($model->validate()){
				$model->fecha=date('Y-m-d',strtotime(str_replace('/', '-', $_POST['fecha'])));
			if($_POST['Historicoviajes']['horaSalida']<>'')
				$model->horaSalida=date("H:i", strtotime($_POST['Historicoviajes']['horaSalida']));
			if(isset($_POST['Historicoviajes']['horaLlegada'])<>'')
			$model->horaLlegada=date("H:i", strtotime($_POST['Historicoviajes']['horaLlegada']));
			}
            if($model->save()){
				$ultimaLectura=Yii::app()->db->createCommand('select lectura from sgu_kilometraje where idvehiculo='.$model->idvehiculo.' order by id desc limit 1')->queryRow();
				$kmViaje=Yii::app()->db->createCommand('select distanciaKm from sgu_viaje where id='.$model->idviaje.'')->queryRow();
				Yii::app()->db->createCommand('INSERT INTO `tsg`.`sgu_kilometraje` (`fecha`,`lectura`,`idvehiculo`) 
			VALUES ("'.date('Y-m-d').'",'.($ultimaLectura['lectura']+$kmViaje['distanciaKm']).','.$model->idvehiculo.')')->query();
                if (Yii::app()->request->isAjaxRequest){
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se registró el viaje correctamente"
                        ));
                    exit;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formViajeRutinario', array('model'=>$model,'fecha'=>$fecha), true)));
            exit;               
        }
        /*else
            $this->render('create',array('model'=>$model,));*/
	}
	
	//especiales
	
	public function actionAgregarViajeEspecial(){
                $model=new Historicoviajes;
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
			if(isset($_POST['fecha']))
				$fecha=date('Y-m-d',strtotime($_POST['fecha']));
			else
				$fecha='';
				
    if(isset($_POST['Historicoviajes'])){
            $model->attributes=$_POST['Historicoviajes'];
			if($_POST['Historicoviajes']['horaSalida']<>'')
				$model->horaSalida=date("H:i", strtotime($_POST['Historicoviajes']['horaSalida']));
			if($_POST['Historicoviajes']['horaLlegada']<>'')
			$model->horaLlegada=date("H:i", strtotime($_POST['Historicoviajes']['horaLlegada']));
            if($model->save()){
				
				$ultimaLectura=Yii::app()->db->createCommand('select lectura from sgu_kilometraje where idvehiculo='.$model->idvehiculo.' order by id desc limit 1')->queryRow();
				$kmViaje=Yii::app()->db->createCommand('select distanciaKm from sgu_viaje where id='.$model->idviaje.'')->queryRow();
				Yii::app()->db->createCommand('INSERT INTO `tsg`.`sgu_kilometraje` (`fecha`,`lectura`,`idvehiculo`) 
				VALUES ("'.date('Y-m-d').'",'.($ultimaLectura['lectura']+$kmViaje['distanciaKm']).','.$model->idvehiculo.')')->query();
			
                if (Yii::app()->request->isAjaxRequest){
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se registró el viaje correctamente"
                        ));
                    exit;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formViajeEspecial', array('model'=>$model,'fecha'=>$fecha), true)));
            exit;               
        }
        /*else
            $this->render('create',array('model'=>$model,));*/
	}
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionUltimosViajes(){
             
					Yii::app()->db->createCommand("INSERT  ignore INTO `tsg`.`sgu_historicoViajes` (`fecha`,`horaSalida`,`horaLlegada`,`idviaje`,`idvehiculo`,`idconductor`,`nroPersonas`)
					select date(now()) as fecha, horaSalida, horaLlegada, idviaje, idvehiculo, idconductor, nroPersonas from sgu_historicoViajes where fecha=(select fecha from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and v.idtipo=1 and fecha<>date(now()) group by fecha order by fecha desc limit 1)")->query();
    
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'hecho', 
				));
            exit;               
        }
        /*else
            $this->render('create',array('model'=>$model,));*/
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Historicoviajes');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function actionCreate()
	{
		$model=new Historicoviajes;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Historicoviajes']))
		{
			$model->attributes=$_POST['Historicoviajes'];
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

		if(isset($_POST['Historicoviajes']))
		{
			$model->attributes=$_POST['Historicoviajes'];
			if($model->save())
				if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Se actualizó la información correctamente"
                        ));
                    exit;               
			}
		}
		 if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formViajeRutinario', array('model'=>$model,'fecha'=>$model->fecha), true)));
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
				$model=$this->loadModel($id);
				
				$ultimaLectura=Yii::app()->db->createCommand('select lectura from sgu_kilometraje where idvehiculo='.$model->idvehiculo.' order by id desc limit 1')->queryRow();
				$kmViaje=Yii::app()->db->createCommand('select distanciaKm from sgu_viaje where id='.$model->idviaje.'')->queryRow();
				Yii::app()->db->createCommand('INSERT INTO `tsg`.`sgu_kilometraje` (`fecha`,`lectura`,`idvehiculo`) 
			VALUES ("'.date('Y-m-d').'",'.($ultimaLectura['lectura']-$kmViaje['distanciaKm']).','.$model->idvehiculo.')')->query();
			
			
			
				
				/*$ultimaLectura=Yii::app()->db->createCommand('select id from sgu_kilometraje where idvehiculo='.$model->idvehiculo.' order by id desc limit 1')->queryRow();
				Yii::app()->db->createCommand('DELETE FROM `tsg`.`sgu_kilometraje` where id='.$ultimaLectura['id'].'')->query();*/
			
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	 public function actionEspeciales(){
		//$Fecha=date("Y-m-d");
		$model=new Historicoviajes();
		
		$dataProvider=new CActiveDataProvider('Historicoviajes',
		array('criteria'=>array('condition'=>'id in (select hv.id as id from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and (v.idtipo=2 or v.idtipo=3))'
		)));
		
		$this->render('especiales',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}
	public function actionRutinarios(){
	
		$Fecha=date("Y-m-d");
		
		if(isset($_GET['fecha'])){
			echo $_GET['fecha'];
			$Fecha=date("Y-m-d", strtotime(str_replace('/', '-', $_GET['fecha'])));
		}
		$dataProvider=new CActiveDataProvider('Historicoviajes',
		array('criteria' => array(
			'condition'=>'t.fecha="'.$Fecha.'" and id in (select hv.id as id from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and v.idtipo=1)',
		)));
		$tot=Yii::app()->db->createCommand("select count(*) as total from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and v.idtipo=1 and fecha<>date(now())")->queryRow();
		
		$this->render('rutinarios',array(
			'dataProvider'=>$dataProvider,
			'total'=>$tot['total'],
		));
	}
	public function actionHistoricoRutinarios(){
	
		$dataProvider=new CActiveDataProvider('Historicoviajes',array('criteria' => array(
			'condition'=>' id in (select hv.id as id from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and v.idtipo=1)',
		)));
		
		if(isset($_GET["fechaIni"]) or isset($_GET["fechaFin"]) or isset($_GET["vehiculo"])){
				if($_GET["fechaIni"]=="" and $_GET["fechaFin"]=="" and $_GET["vehiculo"]==""){
					$dataProvider=new CActiveDataProvider('Historicoviajes',array('criteria' => array(
						'condition' =>'id in (select hv.id as id from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and v.idtipo=1)',
						'order'=>'fecha')));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]==""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					$dataProvider=new CActiveDataProvider('Historicoviajes',array('criteria' => array(
						'condition' =>'id in (select hv.id as id from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and v.idtipo=1) and (fecha>="'.$fechaini.'" and fecha<="'.$fechafin.'")',
						'order'=>'fecha',
					)));		
				}
				if($_GET["fechaIni"]=="" and $_GET["vehiculo"]!=""){
					
					$dataProvider=new CActiveDataProvider('Historicoviajes',array('criteria' => array(
						'condition' =>'id in (select hv.id as id from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and v.idtipo=1) and idvehiculo='.$_GET["vehiculo"].'',
						'order'=>'fecha',
					)));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]!=""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					$dataProvider=new CActiveDataProvider('Historicoviajes',array('criteria' => array(
						'condition' =>'id in (select hv.id as id from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and v.idtipo=1) and (fecha>="'.$fechaini.'" and fecha<="'.$fechafin.'") and idvehiculo='.$_GET["vehiculo"].'',
						'order'=>'fecha',
					)));	
				}
			}
		$dataProvider->setPagination(false);
		$this->render('historicoRutinarios',array(
			'dataProvider'=>$dataProvider,
		));
	}
	 public function actionHistoricoEspeciales(){
		
		
		$dataProvider=new CActiveDataProvider('Historicoviajes',
		array('criteria'=>array('condition'=>'id in (select hv.id as id from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and (v.idtipo=2 or v.idtipo=3))'
		)));
		
		if(isset($_GET["fechaIni"]) or isset($_GET["fechaFin"]) or isset($_GET["vehiculo"])){
				if($_GET["fechaIni"]=="" and $_GET["fechaFin"]=="" and $_GET["vehiculo"]==""){
					$dataProvider=new CActiveDataProvider('Historicoviajes',array('criteria' => array(
						'condition' =>'id in (select hv.id as id from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and (v.idtipo=2 or v.idtipo=3))',
						'order'=>'fecha')));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]==""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					$dataProvider=new CActiveDataProvider('Historicoviajes',array('criteria' => array(
						'condition' =>'id in (select hv.id as id from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and (v.idtipo=2 or v.idtipo=3)) and (fecha>="'.$fechaini.'" and fecha<="'.$fechafin.'")',
						'order'=>'fecha',
					)));		
				}
				if($_GET["fechaIni"]=="" and $_GET["vehiculo"]!=""){
					
					$dataProvider=new CActiveDataProvider('Historicoviajes',array('criteria' => array(
						'condition' =>'id in (select hv.id as id from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and (v.idtipo=2 or v.idtipo=3)) and idvehiculo='.$_GET["vehiculo"].'',
						'order'=>'fecha',
					)));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]!=""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					$dataProvider=new CActiveDataProvider('Historicoviajes',array('criteria' => array(
						'condition' =>'id in (select hv.id as id from sgu_historicoViajes hv, sgu_viaje v where hv.idviaje=v.id and (v.idtipo=2 or v.idtipo=3)) and (fecha>="'.$fechaini.'" and fecha<="'.$fechafin.'") and idvehiculo='.$_GET["vehiculo"].'',
						'order'=>'fecha',
					)));	
				}
			}
			
		$dataProvider->setPagination(false);
		$this->render('historicoEspeciales',array(
			'dataProvider'=>$dataProvider,
			
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Historicoviajes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Historicoviajes']))
			$model->attributes=$_GET['Historicoviajes'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Historicoviajes the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Historicoviajes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Historicoviajes $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='historicoviajes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionActualizarListaConductor(){
		
		$models = Empleado::model()->findAll('idtipoEmpleado=1 order by id DESC');
		$data = array();
		foreach ($models as $mode){
			$data[$mode->id] = $mode->nombre . ' '. $mode->apellido; 
			echo CHtml::tag('option',array('type'=>'text','value'=>(($mode->id))),Chtml::encode(($data[$mode->id])),true);
		}
	}
	public function actionValidarRutaNormal(){
	
			$lista2=Viaje::model()->findAll('idtipo = :id order by id DESC',array(':id'=>'1'));
			foreach($lista2 as $li){
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li->id))),Chtml::encode(($li->viaje)),true);
			
		}
	}
	public function actionValidarRuta($id){
		if($id==0){
			$lista2=Viaje::model()->findAll('idtipo <> :id order by id DESC',array(':id'=>'1'));
			foreach($lista2 as $li){
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li->id))),Chtml::encode(($li->viaje)),true);
			}
		}
		else{
			$lista2=Lugar::model()->findAll('id <> :id',array(':id'=>$id));
			foreach($lista2 as $li){
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li->id))),Chtml::encode(($li->lugar)),true);
			}
		}
	}
	public function actionPuestos($id){
			$modelo=Vehiculo::model()->findByPk($id);
			//echo $modelo->nroPuestos;
			echo CJSON::encode(array('puestos'=>$modelo->nroPuestos,'lista'=>''));	

		/*$models = Empleado::model()->findAll();
		$data = array();
		foreach ($models as $mode){
			$data[$mode->id] = $mode->nombre . ' '. $mode->apellido; 
			//echo CHtml::tag('option',array('type'=>'text','value'=>(($mode->id))),Chtml::encode(($data[$mode->id])),true);
			echo CJSON::encode(array('lista'=>CHtml::tag('option',array('type'=>'text','value'=>(($mode->id))),Chtml::encode(($data[$mode->id])),true)));
		}*/
	}
}
