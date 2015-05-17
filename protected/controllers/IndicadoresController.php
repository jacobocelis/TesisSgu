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
				'actions'=>array('Ind1','Ind2','ind3','ind4','ind5','ind6','ind7','ind8','ind9','ind10','ind11','ind12'),
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
	/*array("unidad","diasMtto","diasDisponible",diasMes)*/
	public function diasMtto($unidad,$fecha,$tipo){
		$diasMtto=0;
		$diasDisponible=0;
		$totalDiasMtto=0;
		$diasDelMes=-1;
		$this->local();
		$validar = Yii::app()->db->createCommand('select DATE_FORMAT(fechaRegistro,"%Y-%m-%d") as fechaRegistro, if(DATE_FORMAT(fechaRegistro,"%Y-%m")<="'.$fecha.'",1,0) as valido from sgu_vehiculo where id="'.$unidad.'"')->queryRow();
		if($validar["valido"]){
			if($tipo==1){
				$consulta= Yii::app()->db->createCommand('select * from sgu_reporteFalla where idvehiculo="'.$unidad.'" and idestatus=3')->queryAll();
				$indice="fechaFalla";
			}
			if($tipo==0){
				$consulta= Yii::app()->db->createCommand('select * from sgu_actividades where idvehiculo="'.$unidad.'" and idestatus=3')->queryAll();
				$indice="fechaComenzada";
			}
			foreach ($consulta as $reg){
				$diasMtto =0;
				/*1era cond*/
				if(date('Y-m', strtotime($reg[$indice]))==date('Y-m', strtotime($reg["fechaRealizada"]))){
					if($fecha==date('Y-m', strtotime($reg[$indice])))
						$diasMtto = ((strtotime($reg["fechaRealizada"])-strtotime($reg[$indice]))/86400)+1;
				}
				/*2da cond*/
				if((date('m', strtotime($reg["fechaRealizada"]))-date('m', strtotime($reg[$indice])))>=1){
					/*este if valida si la variable $fecha está entre las fechas de la falla sino $diasmtto=0*/
					if(date('Y-m', strtotime($reg[$indice]))<=$fecha and $fecha <=date('Y-m', strtotime($reg["fechaRealizada"]))){
						if(date('Y-m', strtotime($reg[$indice]))==$fecha)
							$diasMtto =(intval(date("t",strtotime($reg[$indice])))-intval(date("d",strtotime($reg[$indice]))))+1;		
						elseif(date('Y-m', strtotime($reg["fechaRealizada"]))==$fecha)
							$diasMtto =(intval(date("d",strtotime($reg["fechaRealizada"]))));   
						else
							$diasMtto=intval(date("t",strtotime($fecha)));
					}else
						$diasMtto=0;
				}
				$totalDiasMtto+=$diasMtto;
				
				if($totalDiasMtto>intval(date("t",strtotime($fecha))))
					$totalDiasMtto=intval(date("t",strtotime($fecha)));
			}
			if(date('Y-m', strtotime($validar["fechaRegistro"]))==$fecha){
				$diasDelMes=(intval(date("t",strtotime($fecha)))-intval(date("d",strtotime($validar["fechaRegistro"]))))+1;
				if($totalDiasMtto==0)
					$diasDisponible=intval(date("t",strtotime($fecha)))-intval(date("d",strtotime($validar["fechaRegistro"])));
				else
					$diasDisponible=intval(date("t",strtotime($fecha)))-$totalDiasMtto-intval(date("d",strtotime($validar["fechaRegistro"])));
			}else{
				$diasDelMes=intval(date("t",strtotime($fecha)));
				if($totalDiasMtto==0)
					$diasDisponible=intval(date("t",strtotime($fecha)));
				else
					$diasDisponible=intval(date("t",strtotime($fecha)))-$totalDiasMtto;
			}
			return array($unidad,$totalDiasMtto,$diasDisponible,$totalDiasMtto+$diasDisponible); 
		}
		else
			return array($unidad,0,0,0);
	}
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
	public function local(){
		Yii::app()->db->createCommand("SET lc_time_names = 'es_VE';")->execute();
	}
	public function actionInd1(){
		$this->local();
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
		$this->local();
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
		$this->local();
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
		$this->local();
		$ind = Yii::app()->db->createCommand('select v.numeroUnidad as unidad, count(case rf.tipo when "0" then 1 else null end) as total_Incidentes , count(case rf.tipo when "1" then 1 else null end) as total_Mejoras, IfNULL(round(sum(case when rf.tipo = "0" then re.costoTotal+(re.costoTotal*re.iva) else 0 end),2),0) as costoIncidentes , IfNULL(round(sum(case when rf.tipo = "1" then re.costoTotal+(re.costoTotal*re.iva) else 0 end),2),0) as costoMejoras, IfNULL(round(sum(re.costoTotal+(re.costoTotal*re.iva)),2),0) as costoTotal, DATE_FORMAT(fechaFalla,"%b %y") as fecha  
			FROM sgu_vehiculo v
			LEFT JOIN sgu_reporteFalla rf ON (v.id=rf.idvehiculo)
			LEFT JOIN sgu_recursoFalla re ON (rf.id=re.idreporteFalla)
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

	public function actionInd6(){	
		$this->local();
		$ind = Yii::app()->db->createCommand()
            ->select('v.numeroUnidad as unidad, DATE_FORMAT(fechaSalida,"%b %y") as fecha, count(*) as total, sum(nroPersonas) as personas ')
            ->from('sgu_vehiculo v,sgu_historicoViajes hv')
            ->where('hv.idvehiculo=v.id')
            ->group(' v.id, DATE_FORMAT(fechaSalida,"%b %y")')
            ->order('DATE_FORMAT(fechaSalida,"%b %y"),v.numeroUnidad asc')
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
		$this->local();
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
		$this->local();
		$ind = Yii::app()->db->createCommand('select v.numeroUnidad as unidad, count(case hc.inicial when "0" then 1 else null end) as total_montajes, IfNULL(round(sum(case when hc.inicial = "0" then hc.costounitario+(hc.costounitario*hc.iva) else 0 end),2),0) as costoMontajes, count(case de.idaccionCaucho when "3" then 1 else null end) as total_averias, DATE_FORMAT(hc.fecha,"%b %y") as fecha, IfNULL(round(sum(case de.idaccionCaucho when "3" then drc.costoTotal+(drc.costoTotal*drc.iva) else 0 end),2),0) as costoAverias, IfNULL(round(sum(case de.idaccionCaucho when "3" then drc.costoTotal+(drc.costoTotal*drc.iva) else 0 end)+sum(case when hc.inicial = "0" then hc.costounitario+(hc.costounitario*hc.iva) else 0 end),2),0) as total
				from sgu_vehiculo v
				left join sgu_historicoCaucho hc on(hc.idvehiculo=v.id)
				left join sgu_detalleEventoCa de on(de.idhistoricoCaucho=hc.id)
				left join sgu_detRecCaucho drc on(drc.iddetalleEventoCa=de.id)
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
	public function actionInd9(){
		$this->local();
		$hasta=date('Y');
		$desde=Yii::app()->db->createCommand('select DATE_FORMAT(fechaRegistro,"%Y-%m-%d") as fechaCompleta,DATE_FORMAT(min(fechaRegistro),"%Y-%m") as fecha, DATE_FORMAT(min(fechaRegistro),"%Y") as anno from sgu_vehiculo where activo=1')->queryRow();
		$mes=array();
		$TMEF=array();
		$prueba=array();
		$vehiculos=Yii::app()->db->createCommand('select * from sgu_vehiculo where activo=1')->queryAll();
		for($j=0;$j<(intval($hasta)-intval($desde["anno"]))+1;$j++){
			$diasOperacion=0;
			$anno=intval($desde["anno"]+$j);
			$TME=0;
			$diasOperacion=365;
			if($anno==$hasta)
				$diasOperacion=(strtotime(date("Y-m-d"))-strtotime($hasta."-01-01"))/86400;
			if($desde["anno"]==$anno)
				$diasOperacion=(strtotime($anno."-12-31")-strtotime($desde["fechaCompleta"]))/86400;
			array_push($mes,$anno);
			$NTMC=Yii::app()->db->createCommand('select count(*) as NTMC from sgu_reportefalla where idvehiculo in (select id from sgu_vehiculo where activo=1) and idestatus=3 and year(fechaFalla)="'.$anno.'"')->queryRow();
			if($NTMC["NTMC"]<=0)
				$NTMC["NTMC"]=1;
			$TME=(count($vehiculos)*$diasOperacion)/$NTMC["NTMC"];
			array_push($TMEF,$TME);
			//array_push($prueba, $diasOperacion);
		}
	 	$this->render('ind9',array(
	 		'TMEF'=>$TMEF,
	 		'mes'=>$mes,
	 	));

	}
	public function actionInd10(){
		$this->local();
		$hasta=date('Y');
		$desde=Yii::app()->db->createCommand('select DATE_FORMAT(fechaRegistro,"%Y-%m-%d") as fechaCompleta,DATE_FORMAT(min(fechaRegistro),"%Y-%m") as fecha, DATE_FORMAT(min(fechaRegistro),"%Y") as anno from sgu_vehiculo where activo=1')->queryRow();
		$mes=array();
		$TMPR=array();
		$prueba=array();

		for($j=0;$j<(intval($hasta)-intval($desde["anno"]))+1;$j++){
			$anno=intval($desde["anno"]+$j);
			array_push($mes,$anno);
			$TMP=Yii::app()->db->createCommand('select count(*) as NTMC, sum(DATEDIFF(fechaRealizada,fechaFalla)) as HTMC from sgu_reporteFalla where idvehiculo in (select id from sgu_vehiculo where activo=1) and "'.$anno.'" between year(fechaRealizada) and year(fechaFalla) and idestatus=3')->queryRow();
			if($TMP["NTMC"]<=0)
				$TMP["NTMC"]=1;
			$TMP=($TMP["HTMC"])/$TMP["NTMC"];
			array_push($TMPR,$TMP);
		}
	 	$this->render('ind10',array(
	 		'TMPR'=>$TMPR,
	 		'mes'=>$mes,
	 	));
	}
	/**
	 * Lists all models.
	 */
	public function actionInd11(){
		$this->local();
		$hasta=date('Y');
		$desde=Yii::app()->db->createCommand('select DATE_FORMAT(fechaRegistro,"%Y-%m-%d") as fechaCompleta,DATE_FORMAT(min(fechaRegistro),"%Y-%m") as fecha, DATE_FORMAT(min(fechaRegistro),"%Y") as anno from sgu_vehiculo where activo=1')->queryRow();
		$mes=array();
		$dispTot=array();
		$unidades=array();
		$disponibilidad=array();
		$vehiculos=Yii::app()->db->createCommand('select * from sgu_vehiculo where activo=1')->queryAll();
		foreach ($vehiculos as $veh){
			for($j=0;$j<(intval($hasta)-intval($desde["anno"]))+1;$j++){
				//
				$anno=intval($desde["anno"]+$j);
				//$dispTot=array();
				for($i=1;$i<=12;$i++){
		            if($i>intval(date('m')) and $anno==$hasta)
		            	break; 
					$fecha=$anno.'-'.$i.'-01';
					$fecha_letra = Yii::app()->db->createCommand('select DATE_FORMAT("'.$fecha.'","%Y-%m") as fecha, DATE_FORMAT("'.$fecha.'","%M %y") as mes from dual;')->queryRow();
					
					$datos=$this->diasMtto($veh["id"],$fecha_letra["fecha"],0);
					$disp=(($datos[3]-$datos[1])/$datos[3])*100;
					array_push($dispTot,$disp);
					array_push($mes,$fecha_letra["mes"]);
				}
			}
			array_push($disponibilidad, array('type'=> 'spline','data'=> array_map('floatVal', $dispTot),'name'=>'#'.str_pad((int) $veh["numeroUnidad"],2,"0",STR_PAD_LEFT)));
			$dispTot=array();
		}
		file_put_contents ("borrar.txt",print_r($mes,true)); 
	 	$this->render('ind11',array(
	 		'mes'=>$mes,
	 		'var'=>$disponibilidad,
	 	));
		
	}
	public function actionInd5(){
		$this->local();
		$hasta=date('Y');
		$desde=Yii::app()->db->createCommand('select DATE_FORMAT(fechaRegistro,"%Y-%m-%d") as fechaCompleta,DATE_FORMAT(min(fechaRegistro),"%Y-%m") as fecha, DATE_FORMAT(min(fechaRegistro),"%Y") as anno from sgu_vehiculo where activo=1')->queryRow();
		$mes=array();
		$TMEF=array();
		$prueba=array();
		$vehiculos=Yii::app()->db->createCommand('select * from sgu_vehiculo where activo=1')->queryAll();
		for($j=0;$j<(intval($hasta)-intval($desde["anno"]))+1;$j++){
			$diasOperacion=0;
			$anno=intval($desde["anno"]+$j);
			$TME=0;
			$diasOperacion=365;
			if($anno==$hasta)
				$diasOperacion=(strtotime(date("Y-m-d"))-strtotime($hasta."-01-01"))/86400;
			if($desde["anno"]==$anno)
				$diasOperacion=(strtotime($anno."-12-31")-strtotime($desde["fechaCompleta"]))/86400;
			array_push($mes,$anno);
			$NTMC=Yii::app()->db->createCommand('select count(*) as NTMC from sgu_reportefalla where idvehiculo in (select id from sgu_vehiculo where activo=1) and idestatus=3 and year(fechaFalla)="'.$anno.'"')->queryRow();
			if($NTMC["NTMC"]<=0)
				$NTMC["NTMC"]=1;
			$TME=(count($vehiculos)*$diasOperacion)/$NTMC["NTMC"];
			array_push($TMEF,$TME);
			//array_push($prueba, $diasOperacion);
		}
	 	$this->render('ind9',array(
	 		'TMEF'=>$TMEF,
	 		'mes'=>$mes,

	 		//'var'=>$this->diasMtto(1,"2015-11"),
	 		//'filas'=>$this->filas($ind),
	 	));
		/*for($j=0;$j<(intval($hasta)-intval($desde["anno"]))+1;$j++){
			$totalMtto=0;
			$anno=intval($desde["anno"]+$j);
			$TME=0;
			for($i=1;$i<=12;$i++){
	            if($i>intval(date('m')))
	            	break; 
				$fecha=$anno.'-'.$i.'-01';
				$ind = Yii::app()->db->createCommand('select DATE_FORMAT("'.$fecha.'","%Y-%m") as fecha, DATE_FORMAT("'.$fecha.'","%M %y") as mes from dual;')->queryRow();
				
				foreach ($vehiculos as $veh){
					 $datos=$this->diasMtto($veh["id"],$ind["mes"]);
					 array_push($prueba,$datos[3]);
					 $totalMtto=$totalMtto+=$datos[2];
				}
			}
			array_push($mes,$anno);
			$NTMC=Yii::app()->db->createCommand('select count(*) as NTMC from sgu_reportefalla where idvehiculo in (select id from sgu_vehiculo where activo=1) and idestatus=3 and year(fechaFalla)="'.$anno.'"')->queryRow();
			$TME=(count($vehiculos)*$totalMtto)/$NTMC["NTMC"];
			array_push($TMEF,$TME);
		}*/
	}
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
