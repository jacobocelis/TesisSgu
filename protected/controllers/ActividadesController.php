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
				'actions'=>array('create','update','actualizarMR'),
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
	public function esSabado($fecha){
		$numeroDia=date("w",strtotime($fecha));
		if($numeroDia==6){
			return true;
		}
		else
			return false;
	}
	public function esDomingo($fecha){
		$numeroDia=date("w",strtotime($fecha));
		
		if($numeroDia==0){

			return true;
		}
		else
			return false;
	}
	public function compararFechas($fecha1,$comparador,$fecha2){
		$dia1=date("d",strtotime($fecha1));
		$mes1=date("m",strtotime($fecha1));
		$dia2=date("d",strtotime($fecha2));
		$mes2=date("m",strtotime($fecha2));
		$fecha1=$mes1.$dia1;
		$fecha2=$mes2.$dia2;
		if($comparador==">="){
			if($fecha1>=$fecha2)
				return 1;
			else
				return 0;
		}
		else{
			if($fecha1<=$fecha2)
				return 1;
			else
				return 0;
		}
	}
	public function esFeriado($fecha){
		$feriados = Feriado::model()->findAll();
		foreach ($feriados as $value) {
			//$fecha=date("m-d",strtotime($fecha));
			//$value["fechaInicio"]=date("m-d",strtotime($value["fechaInicio"]));
			//$value["fechaFin"]=date("m-d",strtotime($value["fechaFin"]));
			if(($this->compararFechas($fecha,">=",$value["fechaInicio"]) and $this->compararFechas($fecha,"<=",$value["fechaFin"])) or $this->esSabado($fecha) or $this->esDomingo($fecha))
			return 1;
		}
		return 0;
	}
	public function actionUpdate($id,$idestatus){
	
		$model=$this->loadModel($id);
		if($model->ultimoKm==-1 or $model->ultimoFecha=='0000-01-01')
			$var=1;
		else
			$var=0;
		if(isset($_POST['Actividades'])){
            $model->attributes=$_POST['Actividades'];
            $model->proximoFecha=date("Y-m-d", strtotime(str_replace('/', '-',$model->proximoFecha)));
            if($model->save()){
			//calculo del proximo mantenimiento a realizarse en base al ultimo ingresado
				//$proximoFecha = new DateTime($model->ultimoFecha);
				if($model->noConfirmo==0){
					$model->ultimoFecha=date("Y-m-d", strtotime(str_replace('/', '-',$model->ultimoFecha)));
					$proximoKm=$model->ultimoKm+$model->frecuenciaKm;
				//$proximoFecha->add(new DateInterval('P'.$model->frecuenciaMes.$model->idtiempof0->sqlTimevalues));
				
                	$proximoFecha=date("Y-m-d",strtotime($model->ultimoFecha . "+".$model->frecuenciaMes.$model->idtiempof0->palabraUnidad));
                    /*validamos que se corra la actividad si cae en dia feriado*/
                    
                    /*if($this->esSabado($proximoFecha)){
                    	$proximoFecha=date("Y-m-d",strtotime($proximoFecha . "+2 day"));
                    }
                    if($this->esDomingo($proximoFecha)){
                    	$proximoFecha=date("Y-m-d",strtotime($proximoFecha . "+1 day"));	
                    }*/
                    while($this->esFeriado($proximoFecha)){
                    	$proximoFecha=date("Y-m-d",strtotime($proximoFecha . "+1 day"));
                    }

					Yii::app()->db->createCommand("update `tsg`.`sgu_actividades` set ultimoFecha='".$model->ultimoFecha."',proximoKm='".$proximoKm."', proximoFecha='".$proximoFecha."', idestatus='".$model->idestatus."'
					where id = '".$id."'")->query();
				}

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
		/*
		if(isset($_POST['Actividades']))
		{
			$model->attributes=$_POST['Actividades'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));*/
	}
	public function nuevaActividad($model){

			$proximoKm=$model->kmRealizada+$model->frecuenciaKm;
			$proximoFecha=date("Y-m-d",strtotime($model->fechaRealizada . "+".$model->frecuenciaMes.$model->idtiempof0->palabraUnidad));
			
			if($model->idestatus==4){
				Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_actividades` (`ultimoKm`,`ultimoFecha`,`frecuenciaKm`,`frecuenciaMes`,`proximoKm`,`proximoFecha`,`duracion`,`idprioridad`,`idvehiculo`,`idestatus`,`procedimiento`,`idtiempod`,`idtiempof`,`idactividadesGrupo`,`idactividadMtto`)
				VALUES (".$model->kmRealizada.",'".$model->fechaRealizada."',".$model->frecuenciaKm.",".$model->frecuenciaMes.",".$proximoKm.",'".$proximoFecha."',".$model->duracion.",".$model->idprioridad.",".$model->idvehiculo.",2,'".$model->procedimiento."',".$model->idtiempod.",".$model->idtiempof.",".$model->idactividadesGrupo.",".$model->idactividadMtto.")")->query();
				/*Registro en la bitácora*/
				Bitacora::registrarEvento(Yii::app()->user->id,'INSERT','sgu_actividades');
			}
			if($model->idestatus==3){
				$ult=Yii::app()->db->createCommand("select id from sgu_actividades where idactividadesGrupo=".$model->idactividadesGrupo." and idvehiculo= ".$model->idvehiculo." and idactividadMtto=".$model->idactividadMtto." order by id desc limit 1")->queryRow();
				
			
				Yii::app()->db->createCommand("update `tsg`.`sgu_actividades` set ultimoKm=".$model->kmRealizada.",ultimoFecha='".$model->fechaRealizada."', frecuenciaKm=".$model->frecuenciaKm.",frecuenciaMes=".$model->frecuenciaMes.",proximoKm=".$proximoKm.",proximoFecha='".$proximoFecha."',duracion=0,idprioridad=".$model->idprioridad.",idvehiculo=".$model->idvehiculo.",idestatus=2, procedimiento='".$model->procedimiento."',idtiempod=".$model->idtiempod.",idtiempof=".$model->idtiempof.",idactividadesGrupo=".$model->idactividadesGrupo.",idactividadMtto=".$model->idactividadMtto." where id = '".$ult["id"]."'")->query();	
				/*Registro en la bitácora*/
				Bitacora::registrarEvento(Yii::app()->user->id,'UPDATE','sgu_actividades');
			}
			Yii::app()->db->createCommand("update `tsg`.`sgu_actividades` set idestatus='3' where id = '".$model->id."'")->query();
			/*Registro en la bitácora*/
				Bitacora::registrarEvento(Yii::app()->user->id,'UPDATE','sgu_actividades');
			//inserto el recurso de la actividad
			if($model->idestatus==4){
				$totalRec=Yii::app()->db->createCommand('select * from sgu_actividadRecurso where idactividades="'.$model->id.'"')->queryAll();
                $total=count($totalRec);
				$null='NULL';
				$ultimaAct=Yii::app()->db->createCommand('select id from sgu_actividades order by id desc limit 1')->queryRow();
				for($i=0;$i<$total;$i++){
					Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_actividadRecurso` (`cantidad`,`idactividades`,`idinsumo`,`idrepuesto`,`idservicio`,`idunidad`,`detalle`,`idactividadRecursoGrupo`)
						VALUES (".$totalRec[$i]["cantidad"].",".$ultimaAct["id"].",".($totalRec[$i]["idinsumo"]==null?$null:$totalRec[$i]["idinsumo"]).",".($totalRec[$i]["idrepuesto"]==null?$null:$totalRec[$i]["idrepuesto"]).",".($totalRec[$i]["idservicio"]==null?$null:$totalRec[$i]["idservicio"]).",".$totalRec[$i]["idunidad"].",'".$totalRec[$i]["detalle"]."',".($totalRec[$i]["idactividadRecursoGrupo"]==null?$null:$totalRec[$i]["idactividadRecursoGrupo"]).")")->query();
						/*Registro en la bitácora*/
						Bitacora::registrarEvento(Yii::app()->user->id,'INSERT','sgu_actividadRecurso');
				}
			}
	}

	public function actionActualizarMR($id){
	
		$model=$this->loadModel($id);
		if(isset($_POST['dias']))
			$dias=$_POST['dias'];
		if($model->kmRealizada==-1 or $model->fechaRealizada=='0000-01-01')
			$var=1;
		else
			$var=0;

		if(isset($_POST['Actividades'])){

            $model->attributes=$_POST['Actividades'];
			$model->fechaRealizada=date("Y-m-d", strtotime(str_replace('/', '-',$model->fechaRealizada)));
            
        	$idorden=Yii::app()->db->createCommand("select * from sgu_detalleOrden where idactividades=".$model->id." limit 1")->queryRow();
			$orden=Ordenmtto::model()->findByPk($idorden["idordenMtto"]);
			$fechaorden=date("Y-m-d",strtotime($orden->fecha));
			$duracion=((strtotime($model->fechaRealizada)-strtotime($fechaorden))/86400)+1;

			$model->duracion=$duracion;	
        	if($model->save()){
				if (Yii::app()->request->isAjaxRequest){
			
			//se crea y calcula la nueva actividad
			//$proximoFecha=date("Y-m-d", strtotime(str_replace('/', '-',$model->fechaRealizada)));
			
				/*$proximoKm=$model->kmRealizada+$model->frecuenciaKm;
				$proximoFecha=date("Y-m-d",strtotime($model->fechaRealizada . "+".$model->frecuenciaMes.$model->idtiempof0->palabraUnidad));
				

				if($model->idestatus==4){
					Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_actividades` (`ultimoKm`,`ultimoFecha`,`frecuenciaKm`,`frecuenciaMes`,`proximoKm`,`proximoFecha`,`duracion`,`idprioridad`,`idvehiculo`,`idestatus`,`procedimiento`,`idtiempod`,`idtiempof`,`idactividadesGrupo`,`idactividadMtto`)
					VALUES (".$model->kmRealizada.",'".$model->fechaRealizada."',".$model->frecuenciaKm.",".$model->frecuenciaMes.",".$proximoKm.",'".$proximoFecha."',".$model->duracion.",".$model->idprioridad.",".$model->idvehiculo.",2,'".$model->procedimiento."',".$model->idtiempod.",".$model->idtiempof.",".$model->idactividadesGrupo.",".$model->idactividadMtto.")")->query();
					//Registro en la bitácora
					Bitacora::registrarEvento(Yii::app()->user->id,'INSERT','sgu_actividades');
				}
				if($model->idestatus==3){
					$ult=Yii::app()->db->createCommand("select id from sgu_actividades where idactividadesGrupo=".$model->idactividadesGrupo." and idvehiculo= ".$model->idvehiculo." and idactividadMtto=".$model->idactividadMtto." order by id desc limit 1")->queryRow();
				
					::app()->db->createCommand("update `tsg`.`sgu_actividades` set ultimoKm=".$model->kmRealizada.",ultimoFecha='".$model->fechaRealizada."', frecuenciaKm=".$model->frecuenciaKm.",frecuenciaMes=".$model->frecuenciaMes.",proximoKm=".$proximoKm.",proximoFecha='".$proximoFecha."',duracion=".$model->duracion.",idprioridad=".$model->idprioridad.",idvehiculo=".$model->idvehiculo.",idestatus=2, procedimiento='".$model->procedimiento."',idtiempod=".$model->idtiempod.",idtiempof=".$model->idtiempof.",idactividadesGrupo=".$model->idactividadesGrupo.",idactividadMtto=".$model->idactividadMtto." where id = '".$ult["id"]."'")->query();	
					//Registro en la bitácora
					Bitacora::registrarEvento(Yii::app()->user->id,'UPDATE','sgu_actividades');
				}
				Yii::app()->db->createCommand("update `tsg`.`sgu_actividades` set idestatus='3' where id = '".$id."'")->query();
				//Registro en la bitácora
				Bitacora::registrarEvento(Yii::app()->user->id,'UPDATE','sgu_actividades');
				//inserto el recurso de la actividad
				if($model->idestatus==4){
					$totalRec=Yii::app()->db->createCommand('select * from sgu_actividadRecurso where idactividades="'.$id.'"')->queryAll();
                	$total=count($totalRec);
					$null='NULL';
					$ultimaAct=Yii::app()->db->createCommand('select id from sgu_actividades order by id desc limit 1')->queryRow();
					
					for($i=0;$i<$total;$i++){
						Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_actividadRecurso` (`cantidad`,`idactividades`,`idinsumo`,`idrepuesto`,`idservicio`,`idunidad`,`detalle`,`idactividadRecursoGrupo`)
						VALUES (".$totalRec[$i]["cantidad"].",".$ultimaAct["id"].",".($totalRec[$i]["idinsumo"]==null?$null:$totalRec[$i]["idinsumo"]).",".($totalRec[$i]["idrepuesto"]==null?$null:$totalRec[$i]["idrepuesto"]).",".($totalRec[$i]["idservicio"]==null?$null:$totalRec[$i]["idservicio"]).",".$totalRec[$i]["idunidad"].",'".$totalRec[$i]["detalle"]."',".($totalRec[$i]["idactividadRecursoGrupo"]==null?$null:$totalRec[$i]["idactividadRecursoGrupo"]).")")->query();
						//Registro en la bitácora
						Bitacora::registrarEvento(Yii::app()->user->id,'INSERT','sgu_actividadRecurso');
					}
				}*/
			
                $this->nuevaActividad($model);
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
                'div'=>$this->renderPartial('_formRegistrarMR', array('model'=>$model,'id'=>$var,'dias2'=>$dias), true)));
            exit;               
        }

    }

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
