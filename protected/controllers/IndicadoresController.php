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
				'actions'=>array('Ind1','Ind2','ind3','ind4','ind5','ind6','ind7','ind8','ind9','ind10','ind11','ind12','ind'),
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
	public function filas($ind,$mostrar){
    	if(count($ind)<=10)
    		$filas=0;
    	else
    		$filas=count($ind)-$mostrar;
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
		$hasta=date('Y-m-d');
		$desde=date("Y-m-d",strtotime(date('Y')."-01-01"));
		if(isset($_POST["but"])){
			$hasta=date("Y-m-d",strtotime(str_replace('/', '-',$_POST["Fechafin"])));
			$desde=date("Y-m-d",strtotime(str_replace('/', '-',$_POST["Fechaini"])));
		}
			$ind = Yii::app()->db->createCommand()
                ->select('concat(left(e.nombre,1),". ",e.apellido) as nombre,(count(*)/(select count(*) from sgu_reporteFalla)*100) as total')
                ->from('sgu_empleado e, sgu_reporteFalla rf')
                ->where('rf.idempleado=e.id and e.activo=1  and rf.tipo=0 and rf.fechaFalla between "'.$desde.'" and "'.$hasta.'"')
                ->group('e.nombre')
                ->queryAll();

                //$ind1=array_map('intVal', $ind1); 
	 		$this->render('ind1',array(
	 			'ind'=>$this->convertir($ind),
	 			'desde'=>date("d/m/Y", strtotime($desde)),
	 			'hasta'=>date("d/m/Y", strtotime($hasta)),
	 			));
		 
	}
	public function actionInd2(){
		$this->local();
		$hasta=date('Y-m-d');
		$desde=date("Y-m-d",strtotime(date('Y')."-01-01"));
		if(isset($_POST["but"])){
			$hasta=date("Y-m-d",strtotime(str_replace('/', '-',$_POST["Fechafin"])));
			$desde=date("Y-m-d",strtotime(str_replace('/', '-',$_POST["Fechaini"])));
		}
			$ind = Yii::app()->db->createCommand()
                ->select('concat("Unidad # ",v.numeroUnidad),(count(*)/(select count(*) from sgu_reporteFalla)*100) as total')
                ->from('sgu_vehiculo v, sgu_reporteFalla rf')
                ->where('rf.idvehiculo=v.id and rf.tipo=0 and rf.fechaFalla between "'.$desde.'" and "'.$hasta.'"')
                ->group('v.numeroUnidad')
                ->queryAll();
           
                //$ind1=array_map('intVal', $ind1); 
	 		$this->render('ind2',array(
	 			'ind'=>$this->convertir($ind),
	 			'desde'=>date("d/m/Y", strtotime($desde)),
	 			'hasta'=>date("d/m/Y", strtotime($hasta)),
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
	 		'filas'=>$this->filas($ind,12),
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
			order by fechaFalla,v.numeroUnidad asc;')
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
	 		'filas'=>$this->filas($ind,6),
	 	));
	}

	public function actionInd6(){	
		$this->local();
		$ind = Yii::app()->db->createCommand()
            ->select('v.numeroUnidad as unidad, DATE_FORMAT(fechaSalida,"%b %y") as fecha, count(*) as total, sum(nroPersonas) as personas ')
            ->from('sgu_vehiculo v,sgu_historicoViajes hv')
            ->where('hv.idvehiculo=v.id')
            ->group(' v.id, DATE_FORMAT(fechaSalida,"%b %y")')
            ->order('fechaSalida,v.numeroUnidad asc')
            ->queryAll();
                //$ind1=array_map('intVal', $ind1); 
	 	$this->render('ind6',array(
	 		'unidad'=>$this->separar($ind,"unidad"),
	 		'fecha'=>$this->separar($ind,"fecha"),
	 		'total'=>$this->separar($ind,"total"),
	 		'personas'=>$this->separar($ind,"personas"),
	 		'filas'=>$this->filas($ind,12),
	 	));
	}
	public function actionInd7(){
		$this->local();
		$ind = Yii::app()->db->createCommand()
                ->select('v.numeroUnidad as unidad, count(*) as reparaciones,round(sum(costoTotal+(costoTotal*iva)),2) as total, DATE_FORMAT(fechaRealizada,"%b %y") as fecha ')
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
	 		'filas'=>$this->filas($ind,12),
	 	));
	}
	public function actionInd8(){
		$this->local();
		/*$idvehiculo=0;

			$unidad= Vehiculo::model()->findByPk($idvehiculo);
			$preventivo=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal+(costoTotal*iva)),2),0)  as total from sgu_actividades a, sgu_actividadRecurso ar where a.idvehiculo="'.$idvehiculo.'" and a.id=ar.idactividades and a.idestatus=3')->queryRow();
			$correctivo=Yii::app()->db->createCommand('select ifnull(round(sum(re.costoTotal+(re.costoTotal*re.iva)),2),0) as total FROM sgu_vehiculo v LEFT JOIN sgu_reporteFalla rf ON (v.id=rf.idvehiculo) LEFT JOIN sgu_recursoFalla re ON (rf.id=re.idreporteFalla) where v.id="'.$idvehiculo.'"')->queryRow();
			$neumaticos=Yii::app()->db->createCommand('select ifnull(round(sum(case de.idaccionCaucho when "3" then drc.costoTotal+(drc.costoTotal*drc.iva) else 0 end)+sum(case when hc.inicial = "0" then hc.costounitario+(hc.costounitario*hc.iva) else 0 end),2),0) as total from sgu_vehiculo v left join sgu_historicoCaucho hc on(hc.idvehiculo=v.id) left join sgu_detalleEventoCa de on(de.idhistoricoCaucho=hc.id) left join sgu_detRecCaucho drc on(drc.iddetalleEventoCa=de.id) where v.id="'.$idvehiculo.'"')->queryRow();
			$combustible=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal),2),0) as total from sgu_historicoCombustible hc where hc.idvehiculo="'.$idvehiculo.'"')->queryRow();
			
			$data=array(
			
			array('id'=>1,'Vehiculo'=>$unidad["numeroUnidad"],'Preventivo'=>$preventivo["total"],'Correctivo'=>$correctivo["total"],'Neumaticos'=>$neumaticos["total"],'Combustible'=>$combustible["total"],'Total'=>$preventivo["total"]+$correctivo["total"]+$neumaticos["total"]+$combustible["total"]));*/
		$data=array();
		$unidad= Vehiculo::model()->findAll('activo=1');
		$fechafin=date("Y-m-d");
		$year=date("Y");
		$fechaini="01/01/".$year;
		foreach ($unidad as $u) {

			$preventivo=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal+(costoTotal*iva)),2),0)  as total from sgu_actividades a, sgu_actividadRecurso ar where a.idvehiculo="'.$u["id"].'" and a.id=ar.idactividades and a.idestatus=3 and a.fechaRealizada>="'.$fechaini.'" and a.fechaRealizada<="'.$fechafin.'"')->queryRow();
			$correctivo=Yii::app()->db->createCommand('select ifnull(round(sum(re.costoTotal+(re.costoTotal*re.iva)),2),0) as total FROM sgu_vehiculo v LEFT JOIN sgu_reporteFalla rf ON (v.id=rf.idvehiculo) LEFT JOIN sgu_recursoFalla re ON (rf.id=re.idreporteFalla) where v.id="'.$u["id"].'" and rf.fechaRealizada>="'.$fechaini.'" and rf.fechaRealizada<="'.$fechafin.'"')->queryRow();
			$neumaticos=Yii::app()->db->createCommand('select ifnull(round(sum(case de.idaccionCaucho when "3" then drc.costoTotal+(drc.costoTotal*drc.iva) else 0 end)+sum(case when hc.inicial = "0" then hc.costounitario+(hc.costounitario*hc.iva) else 0 end),2),0) as total from sgu_vehiculo v left join sgu_historicoCaucho hc on(hc.idvehiculo=v.id) left join sgu_detalleEventoCa de on(de.idhistoricoCaucho=hc.id) left join sgu_detRecCaucho drc on(drc.iddetalleEventoCa=de.id) where v.id="'.$u["id"].'"  and de.fechaRealizada>="'.$fechaini.'" and de.fechaRealizada<="'.$fechafin.'"')->queryRow();
			$combustible=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal),2),0) as total from sgu_historicoCombustible hc where hc.idvehiculo="'.$u["id"].'" and date(hc.fecha)>="'.$fechaini.'" and date(hc.fecha)<="'.$fechafin.'"')->queryRow();
		
			array_push($data, array('id'=>$u["numeroUnidad"],'Vehiculo'=>$u["numeroUnidad"],'Preventivo'=>$preventivo["total"],'Correctivo'=>$correctivo["total"],'Neumaticos'=>$neumaticos["total"],'Combustible'=>$combustible["total"],'Total'=>$preventivo["total"]+$correctivo["total"]+$neumaticos["total"]+$combustible["total"]));
		}
		if(isset($_GET["fechaIni"]) or isset($_GET["fechaFin"]) or isset($_GET["vehiculo"])){
			
			if($_GET["fechaIni"]=="" and $_GET["vehiculo"]!=""){
				$idvehiculo=$_GET["vehiculo"];

				$unidad= Vehiculo::model()->findByPk($idvehiculo);
				$preventivo=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal+(costoTotal*iva)),2),0)  as total from sgu_actividades a, sgu_actividadRecurso ar where a.idvehiculo="'.$idvehiculo.'" and a.id=ar.idactividades and a.idestatus=3')->queryRow();
				$correctivo=Yii::app()->db->createCommand('select ifnull(round(sum(re.costoTotal+(re.costoTotal*re.iva)),2),0) as total FROM sgu_vehiculo v LEFT JOIN sgu_reporteFalla rf ON (v.id=rf.idvehiculo) LEFT JOIN sgu_recursoFalla re ON (rf.id=re.idreporteFalla) where v.id="'.$idvehiculo.'"')->queryRow();
				$neumaticos=Yii::app()->db->createCommand('select ifnull(round(sum(case de.idaccionCaucho when "3" then drc.costoTotal+(drc.costoTotal*drc.iva) else 0 end)+sum(case when hc.inicial = "0" then hc.costounitario+(hc.costounitario*hc.iva) else 0 end),2),0) as total from sgu_vehiculo v left join sgu_historicoCaucho hc on(hc.idvehiculo=v.id) left join sgu_detalleEventoCa de on(de.idhistoricoCaucho=hc.id) left join sgu_detRecCaucho drc on(drc.iddetalleEventoCa=de.id) where v.id="'.$idvehiculo.'"')->queryRow();
				$combustible=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal),2),0) as total from sgu_historicoCombustible hc where hc.idvehiculo="'.$idvehiculo.'"')->queryRow();
				
				$data=array(
					array('id'=>1,'Vehiculo'=>$unidad["numeroUnidad"],'Preventivo'=>$preventivo["total"],'Correctivo'=>$correctivo["total"],'Neumaticos'=>$neumaticos["total"],'Combustible'=>$combustible["total"],'Total'=>$preventivo["total"]+$correctivo["total"]+$neumaticos["total"]+$combustible["total"]));

			}
			if($_GET["fechaIni"]=="" and $_GET["fechaFin"]=="" and $_GET["vehiculo"]==""){
				$data=array();
				$unidad= Vehiculo::model()->findAll('activo=1');

				foreach ($unidad as $u) {

					$preventivo=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal+(costoTotal*iva)),2),0)  as total from sgu_actividades a, sgu_actividadRecurso ar where a.idvehiculo="'.$u["id"].'" and a.id=ar.idactividades and a.idestatus=3')->queryRow();
					$correctivo=Yii::app()->db->createCommand('select ifnull(round(sum(re.costoTotal+(re.costoTotal*re.iva)),2),0) as total FROM sgu_vehiculo v LEFT JOIN sgu_reporteFalla rf ON (v.id=rf.idvehiculo) LEFT JOIN sgu_recursoFalla re ON (rf.id=re.idreporteFalla) where v.id="'.$u["id"].'"')->queryRow();
					$neumaticos=Yii::app()->db->createCommand('select ifnull(round(sum(case de.idaccionCaucho when "3" then drc.costoTotal+(drc.costoTotal*drc.iva) else 0 end)+sum(case when hc.inicial = "0" then hc.costounitario+(hc.costounitario*hc.iva) else 0 end),2),0) as total from sgu_vehiculo v left join sgu_historicoCaucho hc on(hc.idvehiculo=v.id) left join sgu_detalleEventoCa de on(de.idhistoricoCaucho=hc.id) left join sgu_detRecCaucho drc on(drc.iddetalleEventoCa=de.id) where v.id="'.$u["id"].'"')->queryRow();
					$combustible=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal),2),0) as total from sgu_historicoCombustible hc where hc.idvehiculo="'.$u["id"].'"')->queryRow();
				
					array_push($data, array('id'=>$u["numeroUnidad"],'Vehiculo'=>$u["numeroUnidad"],'Preventivo'=>$preventivo["total"],'Correctivo'=>$correctivo["total"],'Neumaticos'=>$neumaticos["total"],'Combustible'=>$combustible["total"],'Total'=>$preventivo["total"]+$correctivo["total"]+$neumaticos["total"]+$combustible["total"]));
				}
			}
			if($_GET["fechaIni"]!="" and $_GET["vehiculo"]!=""){
				$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
				$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
				$idvehiculo=$_GET["vehiculo"];
				$unidad= Vehiculo::model()->findByPk($idvehiculo);
				$preventivo=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal+(costoTotal*iva)),2),0)  as total from sgu_actividades a, sgu_actividadRecurso ar where a.idvehiculo="'.$idvehiculo.'" and a.id=ar.idactividades and a.idestatus=3 and a.fechaRealizada>="'.$fechaini.'" and a.fechaRealizada<="'.$fechafin.'"')->queryRow();
				$correctivo=Yii::app()->db->createCommand('select ifnull(round(sum(re.costoTotal+(re.costoTotal*re.iva)),2),0) as total FROM sgu_vehiculo v LEFT JOIN sgu_reporteFalla rf ON (v.id=rf.idvehiculo) LEFT JOIN sgu_recursoFalla re ON (rf.id=re.idreporteFalla) where v.id="'.$idvehiculo.'" and rf.fechaRealizada>="'.$fechaini.'" and rf.fechaRealizada<="'.$fechafin.'"')->queryRow();
				$neumaticos=Yii::app()->db->createCommand('select ifnull(round(sum(case de.idaccionCaucho when "3" then drc.costoTotal+(drc.costoTotal*drc.iva) else 0 end)+sum(case when hc.inicial = "0" then hc.costounitario+(hc.costounitario*hc.iva) else 0 end),2),0) as total from sgu_vehiculo v left join sgu_historicoCaucho hc on(hc.idvehiculo=v.id) left join sgu_detalleEventoCa de on(de.idhistoricoCaucho=hc.id) left join sgu_detRecCaucho drc on(drc.iddetalleEventoCa=de.id) where v.id="'.$idvehiculo.'"  and de.fechaRealizada>="'.$fechaini.'" and de.fechaRealizada<="'.$fechafin.'"')->queryRow();
				$combustible=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal),2),0) as total from sgu_historicoCombustible hc where hc.idvehiculo="'.$idvehiculo.'" and date(hc.fecha)>="'.$fechaini.'" and date(hc.fecha)<="'.$fechafin.'"')->queryRow();
				
				$data=array(
					array('id'=>1,'Vehiculo'=>$unidad["numeroUnidad"],'Preventivo'=>$preventivo["total"],'Correctivo'=>$correctivo["total"],'Neumaticos'=>$neumaticos["total"],'Combustible'=>$combustible["total"],'Total'=>$preventivo["total"]+$correctivo["total"]+$neumaticos["total"]+$combustible["total"]));
			}
			if($_GET["fechaIni"]!="" and $_GET["vehiculo"]==""){
				$data=array();
				$unidad= Vehiculo::model()->findAll('activo <> 0');
				$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
				$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
				foreach ($unidad as $u) {

					$preventivo=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal+(costoTotal*iva)),2),0)  as total from sgu_actividades a, sgu_actividadRecurso ar where a.idvehiculo="'.$u["id"].'" and a.id=ar.idactividades and a.idestatus=3 and a.fechaRealizada>="'.$fechaini.'" and a.fechaRealizada<="'.$fechafin.'"')->queryRow();
					$correctivo=Yii::app()->db->createCommand('select ifnull(round(sum(re.costoTotal+(re.costoTotal*re.iva)),2),0) as total FROM sgu_vehiculo v LEFT JOIN sgu_reporteFalla rf ON (v.id=rf.idvehiculo) LEFT JOIN sgu_recursoFalla re ON (rf.id=re.idreporteFalla) where v.id="'.$u["id"].'" and rf.fechaRealizada>="'.$fechaini.'" and rf.fechaRealizada<="'.$fechafin.'"')->queryRow();
					$neumaticos=Yii::app()->db->createCommand('select ifnull(round(sum(case de.idaccionCaucho when "3" then drc.costoTotal+(drc.costoTotal*drc.iva) else 0 end)+sum(case when hc.inicial = "0" then hc.costounitario+(hc.costounitario*hc.iva) else 0 end),2),0) as total from sgu_vehiculo v left join sgu_historicoCaucho hc on(hc.idvehiculo=v.id) left join sgu_detalleEventoCa de on(de.idhistoricoCaucho=hc.id) left join sgu_detRecCaucho drc on(drc.iddetalleEventoCa=de.id) where v.id="'.$u["id"].'"  and de.fechaRealizada>="'.$fechaini.'" and de.fechaRealizada<="'.$fechafin.'"')->queryRow();
					$combustible=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal),2),0) as total from sgu_historicoCombustible hc where hc.idvehiculo="'.$u["id"].'" and date(hc.fecha)>="'.$fechaini.'" and date(hc.fecha)<="'.$fechafin.'"')->queryRow();
				
					array_push($data, array('id'=>$u["numeroUnidad"],'Vehiculo'=>$u["numeroUnidad"],'Preventivo'=>$preventivo["total"],'Correctivo'=>$correctivo["total"],'Neumaticos'=>$neumaticos["total"],'Combustible'=>$combustible["total"],'Total'=>$preventivo["total"]+$correctivo["total"]+$neumaticos["total"]+$combustible["total"]));
				}
			}
		}
	 	$this->render('ind8',array(
 			'rawData'=>new CArrayDataProvider($data),
 			'vehiculo'=>new Vehiculo,
	 	));

		/*$ind = Yii::app()->db->createCommand('select v.numeroUnidad as unidad, count(case hc.inicial when "0" then 1 else null end) as total_montajes, IfNULL(round(sum(case when hc.inicial = "0" then hc.costounitario+(hc.costounitario*hc.iva) else 0 end),2),0) as costoMontajes, count(case de.idaccionCaucho when "3" then 1 else null end) as total_averias, DATE_FORMAT(hc.fecha,"%b %y") as fecha, IfNULL(round(sum(case de.idaccionCaucho when "3" then drc.costoTotal+(drc.costoTotal*drc.iva) else 0 end),2),0) as costoAverias, IfNULL(round(sum(case de.idaccionCaucho when "3" then drc.costoTotal+(drc.costoTotal*drc.iva) else 0 end)+sum(case when hc.inicial = "0" then hc.costounitario+(hc.costounitario*hc.iva) else 0 end),2),0) as total
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
	 		'filas'=>$this->filas($ind,6),
	 	));*/
	}
	public function getTMEF($desde,$hasta,$unidades,$diasOperacion){
		$NTMC=Yii::app()->db->createCommand('select count(*) as NTMC from sgu_reporteFalla where idvehiculo in (select id from sgu_vehiculo where activo=1) and idestatus=3 and fechaFalla between "'.$desde.'" and "'.$hasta.'" ')->queryRow();
		if($NTMC["NTMC"]<=0)
			$TMEF_total=null;
		else
			$TMEF_total=(count($unidades)*$diasOperacion)/$NTMC["NTMC"];
		return $TMEF_total;
	}
	public function getTMPR($desde,$hasta){
		$TMP=Yii::app()->db->createCommand('select count(*) as NTMC, sum(DATEDIFF(fechaRealizada,fechaFalla)+1) as HTMC from sgu_reporteFalla where idvehiculo in (select id from sgu_vehiculo where activo=1) and fechaFalla between "'.$desde.'" and "'.$hasta.'" and idestatus=3')->queryRow();
			if($TMP["NTMC"]<=0)
				$TMPR_total=null;
			else
				$TMPR_total=($TMP["HTMC"])/$TMP["NTMC"];
		return $TMPR_total;
	}
	public function tiempoMtto($uni,$desde,$hasta){
		$preventivo=0;
		$correctivo=0;
		$totalCo= Yii::app()->db->createCommand('select * from sgu_reporteFalla where idvehiculo="'.$uni["id"].'" and idestatus=3')->queryAll();
		foreach ($totalCo as $co) {
			if($co['fechaFalla']<=$desde and $co['fechaRealizada']>=$hasta){
				
				$correctivo+=abs((strtotime($hasta)-strtotime($desde))/86400)+1;
			}
			/**/
			if($co['fechaFalla']<$desde and $co['fechaRealizada']<$hasta and $desde<$co['fechaRealizada']){
				
				$correctivo+=abs((strtotime($co['fechaRealizada'])-strtotime($desde))/86400)+1;
			}

			if($co['fechaFalla']>=$desde and $co['fechaRealizada']<$hasta){
				 //echo $a;
				$correctivo+=abs((strtotime($co['fechaRealizada'])-strtotime($co['fechaFalla']))/86400)+1;
			}
			if($co['fechaFalla']>$desde and $co['fechaRealizada']>=$hasta and $hasta>=$co['fechaFalla']){
				
				$correctivo+=abs((strtotime($hasta)-strtotime($co['fechaFalla']))/86400)+1;
			}
			if($co['fechaFalla']>$desde and $co['fechaRealizada']<$hasta){
				 //echo $a;
				//$correctivo+=abs((strtotime($co['fechaRealizada'])-strtotime($desde))/86400)+1;
			}
		}
		$totalPre= Yii::app()->db->createCommand('select * from sgu_actividades where idvehiculo="'.$uni["id"].'" and idestatus=3')->queryAll();
		foreach ($totalPre as $pre) {
			if($pre['fechaComenzada']<=$desde and $pre['fechaRealizada']>=$hasta){
				$preventivo+=abs((strtotime($hasta)-strtotime($desde))/86400)+1;
			}
			if($pre['fechaComenzada']>=$desde and $pre['fechaRealizada']<$hasta){
				$preventivo+=abs((strtotime($pre['fechaRealizada'])-strtotime($pre['fechaComenzada']))/86400)+1;
			}
			if($co['fechaComenzada']>$desde and $co['fechaRealizada']>=$hasta){
				$preventivo+=abs((strtotime($hasta)-strtotime($co['fechaComenzada']))/86400)+1;
			}
			if($co['fechaComenzada']>$desde and $co['fechaRealizada']<$hasta){
				$preventivo+=abs((strtotime($co['fechaRealizada'])-strtotime($desde))/86400)+1;
			}
		}
		return ($preventivo+$correctivo);
	}
	public function getDISP($desde,$hasta,$unidades,$diasOperacion,$vehiculo=null){
		$numerador=0;
		$denominador=0;
		if($vehiculo){
			return 0;
		}
		else{
			foreach ($unidades as $uni){
				$numerador+=($diasOperacion-$this->tiempoMtto($uni,$desde,$hasta));
				$denominador+=$diasOperacion;
			}
			return $disponibilidad=($numerador/$denominador)*100;
		}
	}
	public function actionInd9(){
		$meta=Metas::model()->find();
		$this->local();
		$hasta=date('Y-m-d');
		$desde=date("Y-m-d",strtotime(date('Y')."-01-01"));
		//file_put_contents("borrar.txt", print_r($_POST,true));
		if(isset($_POST["but"])){
			$hasta=date("Y-m-d",strtotime(str_replace('/', '-',$_POST["Fechafin"])));
			$desde=date("Y-m-d",strtotime(str_replace('/', '-',$_POST["Fechaini"])));
		}		
		$textoGrupos=array();
		$TMEF_grupos=array();
		
		$grupos = Grupo::model()->findAll();
		/*calculo el temf por grupo*/				
		$diasOperacion=abs((strtotime($hasta)-strtotime($desde))/86400)+1;
			foreach ($grupos as $grupo){
				$vehiculos=Yii::app()->db->createCommand('select * from sgu_vehiculo where activo=1 and idgrupo="'.$grupo["id"].'"')->queryAll();

				array_push($textoGrupos,$grupo["grupo"]);
				$NTMC=Yii::app()->db->createCommand('select count(*) as NTMC from sgu_reporteFalla where idvehiculo in (select id from sgu_vehiculo where activo <> 0 and idgrupo="'.$grupo["id"].'") and idestatus=3 and fechaFalla between "'.$desde.'" and "'.$hasta.'" ')->queryRow();
				if($NTMC["NTMC"]<=0)
					$TME=null;
				else
				$TME=(count($vehiculos)*$diasOperacion)/$NTMC["NTMC"];
				array_push($TMEF_grupos,round($TME,1));
			//array_push($prueba, $diasOperacion);
			}
			/*calculo el temf por cada vehiculo*/
			$textoVehiculos=array();
			$TMEF_vehiculos=array();
			$unidades = Vehiculo::model()->findAll('activo <> 0');
			foreach ($unidades as $uni){
				array_push($textoVehiculos,str_pad((int) $uni["numeroUnidad"],2,"0",STR_PAD_LEFT));
				$NTMC=Yii::app()->db->createCommand('select count(*) as NTMC from sgu_reporteFalla where idvehiculo in (select id from sgu_vehiculo where activo <> 0 and idvehiculo="'.$uni["id"].'") and idestatus=3 and fechaFalla between "'.$desde.'" and "'.$hasta.'" ')->queryRow();
				if($NTMC["NTMC"]<=0)
					$TME=null;
				else
				$TME=(1*$diasOperacion)/$NTMC["NTMC"];
				array_push($TMEF_vehiculos,round($TME,1));
			//array_push($prueba, $diasOperacion);
			}
			
	 	$this->render('ind9',array(
	 		'TMEF_grupos'=>$TMEF_grupos,
	 		'TMEF_vehiculos'=>$TMEF_vehiculos,
	 		'TMEF_total'=>$this->getTMEF($desde,$hasta,$unidades,$diasOperacion),
	 		'grupos'=>$textoGrupos,
	 		'vehiculos'=>$textoVehiculos,
	 		'desde'=>date("d/m/Y", strtotime($desde)),
	 		'hasta'=>date("d/m/Y", strtotime($hasta)),
	 		'meta'=>$meta["TMEF"],
	 	));

	}
	public function actionInd10(){
		$meta=Metas::model()->find();
		$this->local();
		$hasta=date('Y-m-d');
		$desde=date("Y-m-d",strtotime(date('Y')."-01-01"));
		if(isset($_POST["but"])){
			$hasta=date("Y-m-d",strtotime(str_replace('/', '-',$_POST["Fechafin"])));
			$desde=date("Y-m-d",strtotime(str_replace('/', '-',$_POST["Fechaini"])));
		}	
		$mes=array();
		$TMPR=array();
		$TMEF_grupos=array();
		$textoGrupos=array();
		$grupos = Grupo::model()->findAll();
		
		foreach ($grupos as $grupo){	
			array_push($textoGrupos,$grupo["grupo"]);
			$TMP=Yii::app()->db->createCommand('select count(*) as NTMC, sum(DATEDIFF(fechaRealizada,fechaFalla)+1) as HTMC from sgu_reporteFalla where idvehiculo in (select id from sgu_vehiculo where activo=1 and idgrupo="'.$grupo["id"].'" ) and fechaFalla between "'.$desde.'" and "'.$hasta.'" and idestatus=3')->queryRow();
			if($TMP["NTMC"]<=0)
				$TMP["NTMC"]=1;
			$TMP=($TMP["HTMC"])/$TMP["NTMC"];
			array_push($TMPR,round($TMP,1));
		}

			/*calculo el tmpr por cada vehiculo*/
			$textoVehiculos=array();
			$TMPR_vehiculos=array();
			$unidades = Vehiculo::model()->findAll('activo <> 0');
			foreach ($unidades as $uni){
				array_push($textoVehiculos,str_pad((int) $uni["numeroUnidad"],2,"0",STR_PAD_LEFT));
				$TMP=Yii::app()->db->createCommand('select count(*) as NTMC, sum(DATEDIFF(fechaRealizada,fechaFalla)+1) as HTMC from sgu_reporteFalla where idvehiculo = "'.$uni["id"].'"  and fechaFalla between "'.$desde.'" and "'.$hasta.'" and idestatus=3')->queryRow();
				if($TMP["NTMC"]<=0)
					$TMP=null;
				else
					$TMP=($TMP["HTMC"])/$TMP["NTMC"];
				array_push($TMPR_vehiculos,round($TMP,1));
			
			}

	 	$this->render('ind10',array(
	 		'TMPR'=>$TMPR,
	 		'TMPR_vehiculos'=>$TMPR_vehiculos,
	 		'vehiculos'=>$textoVehiculos,
	 		'grupos'=>$textoGrupos,
	 		'meta'=>$meta["TMPR"],
	 		'TMPR_total'=>$this->getTMPR($desde,$hasta),
	 		'desde'=>date("d/m/Y", strtotime($desde)),
	 		'hasta'=>date("d/m/Y", strtotime($hasta)),
	 	));
	}
	/**
	 * Lists all models.
	 */
	public function actionInd11(){
		$meta=Metas::model()->find();
		$textoVehiculos=array();
		$this->local();
		$hasta=date('Y-m-d');
		$desde=date("Y-m-d",strtotime(date('Y')."-01-01"));
		if(isset($_POST["but"])){
			$hasta=date("Y-m-d",strtotime(str_replace('/', '-',$_POST["Fechafin"])));
			$desde=date("Y-m-d",strtotime(str_replace('/', '-',$_POST["Fechaini"])));
		}
		$mes=array();
		$dispTot=array();
		$dispMensualVeh=array();
		$unidades = Vehiculo::model()->findAll('activo <> 0');
		$diasOperacion=abs((strtotime($hasta)-strtotime($desde))/86400)+1;
		$disponibilidad=array();
		$vehiculos=Yii::app()->db->createCommand('select * from sgu_vehiculo where activo <> 0')->queryAll();
		foreach ($vehiculos as $veh){
			array_push($textoVehiculos,str_pad((int) $veh["numeroUnidad"],2,"0",STR_PAD_LEFT));
			/*aqui calculo disponiblidad total por vehiculo en periodo seleccionado*/
			array_push($dispMensualVeh,$this->getDISP($desde,$hasta,$unidades,$diasOperacion,$veh['id']));
			/**/
			for($j=0;$j<(intval($hasta)-intval($desde))+1;$j++){
				//
				$anno=intval($desde+$j);
				if($j==0)
					$inicio=intval(date('m',strtotime($desde)));
				else
					$inicio=1;
				for($i=$inicio;$i<=12;$i++){
		            if($i>intval(date('m',strtotime($hasta))) and $anno==$hasta)
		            	break; 
					$fecha=$anno.'-'.$i.'-01';
					$fecha_letra = Yii::app()->db->createCommand('select DATE_FORMAT("'.$fecha.'","%Y-%m") as fecha, DATE_FORMAT("'.$fecha.'","%b %y") as mes from dual;')->queryRow();
					$preven=$this->diasMtto($veh["id"],$fecha_letra["fecha"],0);
					$correc=$this->diasMtto($veh["id"],$fecha_letra["fecha"],1);
					
					if($preven[3]==0 and $correc[3]==0)
						array_push($dispTot,null);	
					else{
						$datos=array($preven[0],$preven[1]+$correc[1],abs($preven[2]-$correc[2]),$preven[3]);
						$disp=(($datos[3]-$datos[1])/$datos[3])*100;
						array_push($dispTot,floatval($disp));
					}					
					array_push($mes,$fecha_letra["mes"]);
				}
			}
			array_push($disponibilidad, array('type'=> 'spline','data'=>$dispTot,'name'=>'#'.str_pad((int) $veh["numeroUnidad"],2,"0",STR_PAD_LEFT)));
			$dispTot=array();
		}
	 	$this->render('ind11',array(
	 		'mes'=>$mes,
	 		'dispMensual'=>$disponibilidad,
	 		'vehiculos'=>$textoVehiculos,
	 		'filas'=>$this->filas(isset($disponibilidad[0]["data"])?$disponibilidad[0]["data"]:0,12),
	 		'desde'=>date("d/m/Y", strtotime($desde)),
	 		'hasta'=>date("d/m/Y", strtotime($hasta)),
	 		'meta'=>$meta["DISP"],
	 		'DISP_total'=>$this->getDISP($desde,$hasta,$unidades,$diasOperacion),
	 		'dispPeriodo'=>$dispMensualVeh,
	 	));
	}
	public function actionInd(){
		$meta=Metas::model()->find();
		$textoVehiculos=array();
		$this->local();
		$hasta=date('Y-m-d');
		$desde=date("Y-m-d",strtotime(date('Y')."-01-01"));
		if(isset($_POST["but"])){
			$hasta=date("Y-m-d",strtotime(str_replace('/', '-',$_POST["Fechafin"])));
			$desde=date("Y-m-d",strtotime(str_replace('/', '-',$_POST["Fechaini"])));
		}
		$mes=array();
		$dispTot=array();
		$dispMensualVeh=array();
		$unidades = Vehiculo::model()->findAll('activo <> 0');
		$diasOperacion=abs((strtotime($hasta)-strtotime($desde))/86400)+1;
		$disponibilidad=array();
		$vehiculos=Yii::app()->db->createCommand('select * from sgu_vehiculo where activo <> 0')->queryAll();
		foreach ($vehiculos as $veh){
			array_push($textoVehiculos,str_pad((int) $veh["numeroUnidad"],2,"0",STR_PAD_LEFT));
			/*aqui calculo disponiblidad total por vehiculo en periodo seleccionado*/
			array_push($dispMensualVeh,$this->getDISP($desde,$hasta,$unidades,$diasOperacion,$veh['id']));
			/**/
			for($j=0;$j<(intval($hasta)-intval($desde))+1;$j++){
				//
				$anno=intval($desde+$j);
				if($j==0)
					$inicio=intval(date('m',strtotime($desde)));
				else
					$inicio=1;
				for($i=$inicio;$i<=12;$i++){
		            if($i>intval(date('m',strtotime($hasta))) and $anno==$hasta)
		            	break; 
					$fecha=$anno.'-'.$i.'-01';
					$fecha_letra = Yii::app()->db->createCommand('select DATE_FORMAT("'.$fecha.'","%Y-%m") as fecha, DATE_FORMAT("'.$fecha.'","%b %y") as mes from dual;')->queryRow();
					$preven=$this->diasMtto($veh["id"],$fecha_letra["fecha"],0);
					$correc=$this->diasMtto($veh["id"],$fecha_letra["fecha"],1);
					
					if($preven[3]==0 and $correc[3]==0)
						array_push($dispTot,null);	
					else{
						$datos=array($preven[0],$preven[1]+$correc[1],abs($preven[2]-$correc[2]),$preven[3]);
						$disp=(($datos[3]-$datos[1])/$datos[3])*100;
						array_push($dispTot,floatval($disp));
					}					
					array_push($mes,$fecha_letra["mes"]);
				}
			}
			array_push($disponibilidad, array('type'=> 'spline','data'=>$dispTot,'name'=>'#'.str_pad((int) $veh["numeroUnidad"],2,"0",STR_PAD_LEFT)));
			$dispTot=array();
		}
	 	$this->render('ind',array(
	 		'mes'=>$mes,
	 		'dispMensual'=>$disponibilidad,
	 		'vehiculos'=>$textoVehiculos,
	 		'filas'=>$this->filas(isset($disponibilidad[0]["data"])?$disponibilidad[0]["data"]:0,12),
	 		'desde'=>date("d/m/Y", strtotime($desde)),
	 		'hasta'=>date("d/m/Y", strtotime($hasta)),
	 		'meta'=>$meta["DISP"],
	 		'meta_falla'=>$meta["TMEF"],
	 		'meta_rep'=>$meta["TMPR"],
	 		'DISP_total'=>$this->getDISP($desde,$hasta,$unidades,$diasOperacion),
	 		'TMEF_total'=>$this->getTMEF($desde,$hasta,$unidades,$diasOperacion),
	 		'TMPR_total'=>$this->getTMPR($desde,$hasta),
	 		'dispPeriodo'=>$dispMensualVeh,
	 	));
	}
	public function actionInd5(){
		$this->local();
		$idvehiculo=0;
		if(isset($_POST["id"]) and isset($_POST["valor"]) and $_POST["valor"]<>""){
			$idvehiculo=$_POST["id"];
		}
		if(isset($_GET["idveh"]) and $_GET["idveh"]<>"")
			$idvehiculo=$_GET["idveh"];

		$veh=new CActiveDataProvider('Vehiculo',array("criteria"=>array("condition"=>"id='".$idvehiculo."' and activo=1","limit"=>"1"),'pagination' => false));
		$preventivo=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal+(costoTotal*iva)),2),0)  as total from sgu_actividades a, sgu_actividadRecurso ar where a.idvehiculo="'.$idvehiculo.'" and a.id=ar.idactividades and a.idestatus=3')->queryRow();
		$correctivo=Yii::app()->db->createCommand('select ifnull(round(sum(re.costoTotal+(re.costoTotal*re.iva)),2),0) as total FROM sgu_vehiculo v LEFT JOIN sgu_reporteFalla rf ON (v.id=rf.idvehiculo) LEFT JOIN sgu_recursoFalla re ON (rf.id=re.idreporteFalla) where v.id="'.$idvehiculo.'"')->queryRow();
		$neumaticos=Yii::app()->db->createCommand('select ifnull(round(sum(case de.idaccionCaucho when "3" then drc.costoTotal+(drc.costoTotal*drc.iva) else 0 end)+sum(case when hc.inicial = "0" then hc.costounitario+(hc.costounitario*hc.iva) else 0 end),2),0) as total from sgu_vehiculo v left join sgu_historicoCaucho hc on(hc.idvehiculo=v.id) left join sgu_detalleEventoCa de on(de.idhistoricoCaucho=hc.id) left join sgu_detRecCaucho drc on(drc.iddetalleEventoCa=de.id) where v.id="'.$idvehiculo.'"')->queryRow();
		$combustible=Yii::app()->db->createCommand('select ifnull(round(sum(costoTotal),2),0) as total from sgu_historicoCombustible hc where hc.idvehiculo="'.$idvehiculo.'"')->queryRow();
		
		$data=array(
			array('id'=>1,'Preventivo'=>$preventivo["total"],'Correctivo'=>$correctivo["total"],'Neumaticos'=>$neumaticos["total"],'Combustible'=>$combustible["total"],'Total'=>$preventivo["total"]+$correctivo["total"]+$neumaticos["total"]+$combustible["total"]));

		if(isset($_POST["id"]) and isset($_POST["valor"]) and $_POST["valor"]<>""){
			echo CJSON::encode(array(
                'valor'=>round((($data[0]["Total"]/$_POST["valor"])*100),2),
				));
			exit;
		}
	 	$this->render('ind5',array(
	 		'rawData'=>new CArrayDataProvider($data, array('pagination' => false)),
	 		'veh'=>$veh,
	 	));
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
