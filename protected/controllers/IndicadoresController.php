<?php

class IndicadoresController extends Controller
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
				'actions'=>array(''),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('Ind1','Ind2','ind3','ind4','ind5','ind6','ind7','ind8'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
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
	public function filas($ind){
    	if(count($ind)<=10)
    		$filas=0;
    	else
    		$filas=count($ind)-6;
    	return $filas;
	}
	public function convertir($sql){
		$fila=array();
		$todo=array();
		$resultado=$sql;
		foreach ($sql as $key) {
			foreach ($key as $k => $value) {
				if(is_numeric($value))	
					array_push($fila,intval($value));
				else
					array_push($fila,$value);
			}
			array_push($todo,$fila);
			$fila=array();	
		}
		return $todo;
	}
	public function separar($sql,$columna){
		$col=array();
		foreach ($sql as $value) {
			if($columna=="unidad")
				array_push($col,str_pad((int) $value[$columna],2,"0",STR_PAD_LEFT));
			else
				array_push($col, $value[$columna]);
		}
		return $col;
	}
	public function actionInd1(){
			$ind = Yii::app()->db->createCommand()
                ->select('concat(left(e.nombre,1),". ",e.apellido) as nombre,(count(*)/(select count(*) from sgu_reporteFalla)*100) as total')
                ->from('sgu_empleado e, sgu_reporteFalla rf')
                ->where('rf.idempleado=e.id and e.activo=1  and rf.tipo=0')
                ->group('e.nombre')
                ->queryAll();

                //$ind1=array_map('intVal', $ind1); 
	 		$this->render('ind1',array(
	 			'ind'=>$this->convertir($ind),
	 			));
		 
	}
	public function actionInd2(){
			$ind = Yii::app()->db->createCommand()
                ->select('concat("Unidad # ",v.numeroUnidad),(count(*)/(select count(*) from sgu_reporteFalla)*100) as total')
                ->from('sgu_vehiculo v, sgu_reporteFalla rf')
                ->where('rf.idvehiculo=v.id and rf.tipo=0')
                ->group('v.numeroUnidad')
                ->queryAll();
           
                //$ind1=array_map('intVal', $ind1); 
	 		$this->render('ind2',array(
	 			'ind'=>$this->convertir($ind),
	 			));
		 
	}
	public function actionInd3(){
		Yii::app()->db->createCommand("SET lc_time_names = 'es_VE';")->execute();
			$ind = Yii::app()->db->createCommand()
                ->select('v.numeroUnidad as unidad,DATE_FORMAT(fecha,"%b %y") as mes, round(sum(costoTotal),2) as total, sum(litros) as litros')
                ->from('sgu_historicoCombustible hc, sgu_vehiculo v')
                ->where('hc.idvehiculo=v.id')
                ->group('idvehiculo,DATE_FORMAT(fecha,"%b %y")')
                ->order('fecha,idvehiculo asc')
                ->queryAll();
           
                //$ind1=array_map('intVal', $ind1); 
	 	$this->render('ind3',array(
	 		'unidad'=>$this->separar($ind,"unidad"),
	 		'mes'=>$this->separar($ind,"mes"),
	 		'total'=>$this->separar($ind,"total"),
	 		'litros'=>$this->separar($ind,"litros"),
	 		'filas'=>$this->filas($ind),
	 	));
	}
	public function actionInd4(){
		
		$ind = Yii::app()->db->createCommand('select v.numeroUnidad as unidad, count(case rf.tipo when "0" then 1 else null end) as total_Incidentes , count(case rf.tipo when "1" then 1 else null end) as total_Mejoras, IfNULL(round(sum(case when rf.tipo = "0" then re.costoTotal+(re.costoTotal*re.iva) else 0 end),2),0) as costoIncidentes , IfNULL(round(sum(case when rf.tipo = "1" then re.costoTotal+(re.costoTotal*re.iva) else 0 end),2),0) as costoMejoras, IfNULL(round(sum(re.costoTotal+(re.costoTotal*re.iva)),2),0) as costoTotal, DATE_FORMAT(fechaFalla,"%b %y") as fecha  
			FROM sgu_vehiculo v
			LEFT JOIN sgu_reporteFalla rf ON (v.id=rf.idvehiculo)
			LEFT JOIN sgu_recursofalla re ON (rf.id=re.idreporteFalla)
			where year(rf.fechaFalla)
			group by v.id,DATE_FORMAT(fechaFalla,"%b %y")
			order by rf.fechaFalla,v.numeroUnidad asc;')
                ->queryAll();

        //$ind1=array_map('intVal', $ind1); 
	 	$this->render('ind4',array(
	 		'unidad'=>$this->separar($ind,"unidad"),
	 		'fecha'=>$this->separar($ind,"fecha"),
	 		'total_Incidentes'=>$this->separar($ind,"total_Incidentes"),
	 		'total_Mejoras'=>$this->separar($ind,"total_Mejoras"),
	 		'costoIncidentes'=>$this->separar($ind,"costoIncidentes"),
	 		'costoMejoras'=>$this->separar($ind,"costoMejoras"),
	 		'costoTotal'=>$this->separar($ind,"costoTotal"),
	 		'filas'=>$this->filas($ind),
	 	));
	}
	public function actionInd5(){
		
			$ind = Yii::app()->db->createCommand()
                ->select('v.numeroUnidad as unidad, count(*) as reparaciones,round(sum(costoTotal+(costoTotal*iva)),2) as total, DATE_FORMAT(fechaFalla,"%Y") as fecha ')
                ->from('sgu_vehiculo v, sgu_reporteFalla rf, sgu_recursoFalla f')
                ->where('rf.idvehiculo=v.id and rf.id=f.idreporteFalla ')
                ->group('v.id,year(rf.fechaFalla)')
                ->order('year(fechaFalla),v.numeroUnidad asc')
                ->queryAll();


                //$ind1=array_map('intVal', $ind1); 
	 	$this->render('ind5',array(
	 		'unidad'=>$this->separar($ind,"unidad"),
	 		'fecha'=>$this->separar($ind,"fecha"),
	 		'total'=>$this->separar($ind,"total"),
	 		'reparaciones'=>$this->separar($ind,"reparaciones"),
	 		'filas'=>$this->filas($ind),
	 	));
	}
	public function actionInd6(){	
		$ind = Yii::app()->db->createCommand()
            ->select('v.numeroUnidad as unidad, year(fechaSalida) as fecha, count(*) as total, sum(nroPersonas) as personas ')
            ->from('sgu_vehiculo v,sgu_historicoViajes hv')
            ->where('hv.idvehiculo=v.id')
            ->group(' v.id, year(fechaSalida)')
            ->order('year(fechaSalida),v.numeroUnidad asc')
            ->queryAll();
                //$ind1=array_map('intVal', $ind1); 
	 	$this->render('ind6',array(
	 		'unidad'=>$this->separar($ind,"unidad"),
	 		'fecha'=>$this->separar($ind,"fecha"),
	 		'total'=>$this->separar($ind,"total"),
	 		'personas'=>$this->separar($ind,"personas"),
	 		'filas'=>$this->filas($ind),
	 	));
	}
	public function actionInd7(){
		
		$ind = Yii::app()->db->createCommand()
                ->select('v.numeroUnidad as unidad, count(*) as reparaciones,round(sum(costoTotal+(costoTotal)),2) as total, DATE_FORMAT(fechaRealizada,"%b %y") as fecha ')
                ->from('sgu_vehiculo v, sgu_actividades a, sgu_actividadRecurso ar')
                ->where('a.idvehiculo=v.id and a.id=ar.idactividades and a.idestatus=3')
                ->group('v.id,DATE_FORMAT(fechaRealizada,"%b %y")')
                ->order('fechaRealizada,v.numeroUnidad asc')
                ->queryAll();

	 	$this->render('ind7',array(
	 		'unidad'=>$this->separar($ind,"unidad"),
	 		'fecha'=>$this->separar($ind,"fecha"),
	 		'total'=>$this->separar($ind,"total"),
	 		'reparaciones'=>$this->separar($ind,"reparaciones"),
	 		'filas'=>$this->filas($ind),
	 	));
	}
	public function actionInd8(){
		
		$ind = Yii::app()->db->createCommand('select v.numeroUnidad as unidad, count(case hc.inicial when "0" then 1 else null end) as total_montajes, IfNULL(round(sum(case when hc.inicial = "0" then hc.costounitario+(hc.costounitario*hc.iva) else 0 end),2),0) as costoMontajes, count(case de.idaccionCaucho when "3" then 1 else null end) as total_averias, DATE_FORMAT(hc.fecha,"%b %y") as fecha, IfNULL(round(sum(case de.idaccionCaucho when "3" then drc.costoTotal+(drc.costoTotal*drc.iva) else 0 end),2),0) as costoAverias, IfNULL(round(sum(case de.idaccionCaucho when "3" then drc.costoTotal+(drc.costoTotal*drc.iva) else 0 end)+sum(case when hc.inicial = "0" then hc.costounitario+(hc.costounitario*hc.iva) else 0 end),2),0) as total
				from sgu_vehiculo v
				left join sgu_historicoCaucho hc on(hc.idvehiculo=v.id)
				left join sgu_detalleEventoCa de on(de.idhistoricoCaucho=hc.id)
				left join sgu_detrecCaucho drc on(drc.iddetalleEventoCa=de.id)
				where year(hc.fecha)
				group by v.id, DATE_FORMAT(fecha,"%b %y") 
				order by hc.fecha,v.numeroUnidad asc;')
                ->queryAll();

	 	$this->render('ind8',array(
	 		'unidad'=>$this->separar($ind,"unidad"),
	 		'fecha'=>$this->separar($ind,"fecha"),
	 		'total_montajes'=>$this->separar($ind,"total_montajes"),
	 		'costoMontajes'=>$this->separar($ind,"costoMontajes"),
	 		'total_averias'=>$this->separar($ind,"total_averias"),
	 		
	 		'costoAverias'=>$this->separar($ind,"costoAverias"),
	 		'total'=>$this->separar($ind,"total"),
	 		'filas'=>$this->filas($ind),
	 	));
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
		$dataProvider=new CActiveDataProvider('Tipo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tipo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tipo']))
			$model->attributes=$_GET['Tipo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tipo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Tipo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tipo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tipo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
