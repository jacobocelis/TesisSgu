<?php

class MttoCorrectivoController extends Controller
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
				'actions'=>array('RegistroIncidente','index','view','falla','registrarFalla','ajaxObtenerFallas','ajaxObtenerConductor','nuevaFalla','ajaxActualizarListaFallas','ajaxActualizarListaMejora','crearOrdenCorrectiva','obtenerActividad','agregarRecurso','iniciales','crearordenpreventiva','crearOrden','verOrdenes','cambiarFecha','mttocRealizados','registrarFacturacion','agregarFactura','estatusOrden','cerrarOrdenes','HistoricoCorrectivo','historicoOrdenes','historicoGastos','vistaPrevia','vistaPreviaPDF','generarPdf','correo','actualizarSpan','agregarRecursoAdicional','insumos','repuesto','ActualizarCheck','RegistrarMejora','Mejora','nuevaMejora','historicoMejoras','ActualizarSpanListas','parametros'),
				'users'=>array('@'),
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
	public function estatusOrden($id){
		return Ordenmtto::model()->findByPk($id)->idestatus;
	}
	 public function actionActualizarSpan(){
		$mi=Yii::app()->db->createCommand("select count(*) as total from sgu_actividades where idestatus=1")->queryRow();
		
		echo CJSON::encode(array(
			'total'=>$mi["total"],
			'color'=>$this->getColor($mi["total"]),
		));
	 }
	  public function actionActualizarSpanListas(){
		$mi=Yii::app()->db->createCommand("select count(*) as total from sgu_ordenMtto where idestatus=6 and tipo=1")->queryRow();
		
		echo CJSON::encode(array(
			'total'=>$mi["total"],
			'color'=>$this->getColor($mi["total"]),
		));
	 }
	public function actionParametros(){

	$gridFallas=new CActiveDataProvider('Falla',array('criteria' => array(
		'condition' =>"tipo=0",
		'order'=>'id')));

	$gridMejoras=new CActiveDataProvider('Falla',array('criteria' => array(
		'condition' =>"tipo=1",
		'order'=>'id')));

		$this->render('parametros',array(
			'gridFallas'=>$gridFallas,
			'gridMejoras'=>$gridMejoras,
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
		));
	}

	public function generarPDF($id){
		$orden=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'id='.$id."")
			,'pagination'=>array('pageSize'=>9999999)));
			
		$idvehiculo=Yii::app()->db->createCommand("select distinct( a.idvehiculo), count(*) as totAct from sgu_reporteFalla a, sgu_detalleOrdenCo d where d.idreporteFalla=a.id and d.idordenMtto=".$id." group by a.idvehiculo")->queryAll();
		$totalVeh=count($idvehiculo);
		
		//$actividades=Yii::app()->db->createCommand("select idactividades from sgu_detalleorden where idordenMtto=".$id."")->queryAll();
		
		for($i=0;$i<$totalVeh;$i++){
			$vehiculos[]=new CActiveDataProvider('Vehiculo',array('criteria' => array(
			'condition' =>'id="'.$idvehiculo[$i]["idvehiculo"].'"',
			)));
			
		$totAct=Yii::app()->db->createCommand('select idreporteFalla as id from sgu_detalleOrdenCo where idordenMtto="'.$id.'" and idreporteFalla in(select a.id from sgu_reporteFalla a where a.idvehiculo="'.$idvehiculo[$i]["idvehiculo"].'")')->queryAll();
		
		for($j=0;$j<$idvehiculo[$i]["totAct"];$j++){		
				$actividades[$i][$j]=new CActiveDataProvider('Reportefalla',array('criteria' => array(
				'condition' =>'id="'.$totAct[$j]["id"].'"',
				)));
				$recursos[$i][$j]=new CActiveDataProvider('Recursofalla',array('criteria' => array(
				'condition' =>'idreporteFalla="'.$totAct[$j]["id"].'"',
				)));
			}
		}
		 $mPDF1 = Yii::app()->ePdf->mpdf(); //Esto lo pueden configurar como quieren, para eso deben de entrar en la web de MPDF para ver todo lo que permite.
		 //$mPDF1->useOnlyCoreFonts = true;
		 $mPDF1->SetTitle("Solicitud de servicio");
		 $mPDF1->SetAuthor("J&M");
		 //$mPDF1->SetWatermarkText("U.N.E.T.");
		 $mPDF1->showWatermarkText = false;
		 $mPDF1->watermark_font = 'DejaVuSansCondensed';
		 $mPDF1->watermarkTextAlpha = 0.1;
		 $mPDF1->SetDisplayMode('fullpage');
		 $mPDF1->WriteHTML($this->renderPartial('vistaPreviaPDF',array(
			'vehiculos'=>$vehiculos,
			'totalVeh'=>$totalVeh,
			'actividades'=>$actividades,
			'idvehiculo'=>$idvehiculo,
			'recursos'=>$recursos,
			'orden'=>$orden,
			'correo'=>1,
		),true));
		 $mPDF1->Output('Orden-'.$id.'.pdf','F');
	}	 

public function actionCorreo($id){
		//se envia desde la vista mail
			$model = new Mail;
		if(isset($_POST['Mail'])){
				$model->attributes=$_POST['Mail'];
				if($model->validate()){
					$this->GenerarPDF($id);
					$adjunto="Orden-".$id.".pdf";
					$correo = PublicoController::enviarMail($model->to,$model->from,$model->subject,$model->body,$adjunto);
					if($correo){
						echo CJSON::encode(array(
							'status'=>'success', 
							'div'=>"La órden fue enviada con éxito"
							));
						//unlink(Yii::app()->basePath.'/../ordenes/Orden-'.$id.'.pdf');
						unlink('Orden-'.$id.'.pdf');
						exit;
						
					}
					else{
						echo CJSON::encode(array(
							'status'=>'failure', 
							'div'=>"No se pudo enviar la órden. Contacte al administrador"
							));
						exit;
					}
				}
		}
			if (Yii::app()->request->isAjaxRequest){	
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formMail', array('model'=>$model), true)
				));
            exit;               
        }
	}
	public function actionVistaPreviaPDF($id){
		$orden=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'id='.$id."")
			,'pagination'=>array('pageSize'=>9999999)));
			
		$idvehiculo=Yii::app()->db->createCommand("select distinct( a.idvehiculo), count(*) as totAct from sgu_reporteFalla a, sgu_detalleOrdenCo d where d.idreporteFalla=a.id and d.idordenMtto=".$id." group by a.idvehiculo")->queryAll();
		$totalVeh=count($idvehiculo);
		
		//$actividades=Yii::app()->db->createCommand("select idactividades from sgu_detalleorden where idordenMtto=".$id."")->queryAll();
		
		for($i=0;$i<$totalVeh;$i++){
			$vehiculos[]=new CActiveDataProvider('Vehiculo',array('criteria' => array(
			'condition' =>'id="'.$idvehiculo[$i]["idvehiculo"].'"',
			)));
			
		$totAct=Yii::app()->db->createCommand('select idreporteFalla as id from sgu_detalleOrdenCo where idordenMtto="'.$id.'" and idreporteFalla in(select a.id from sgu_reporteFalla a where a.idvehiculo="'.$idvehiculo[$i]["idvehiculo"].'")')->queryAll();
		
		for($j=0;$j<$idvehiculo[$i]["totAct"];$j++){		
				$actividades[$i][$j]=new CActiveDataProvider('Reportefalla',array('criteria' => array(
				'condition' =>'id="'.$totAct[$j]["id"].'"',
				)));
				$recursos[$i][$j]=new CActiveDataProvider('Recursofalla',array('criteria' => array(
				'condition' =>'idreporteFalla="'.$totAct[$j]["id"].'"',
				)));
			}
		}
		 $mPDF1 = Yii::app()->ePdf->mpdf(); //Esto lo pueden configurar como quieren, para eso deben de entrar en la web de MPDF para ver todo lo que permite.
		 //$mPDF1->useOnlyCoreFonts = true;
		 $mPDF1->SetTitle("Solicitud de servicio");
		 $mPDF1->SetAuthor("J&M");
		 //$mPDF1->SetWatermarkText("U.N.E.T.");
		 $mPDF1->showWatermarkText = false;
		 $mPDF1->watermark_font = 'DejaVuSansCondensed';
		 $mPDF1->watermarkTextAlpha = 0.1;
		 $mPDF1->SetDisplayMode('fullpage');
		 $mPDF1->WriteHTML($this->renderPartial('vistaPreviaPDF',array(
			'vehiculos'=>$vehiculos,
			'totalVeh'=>$totalVeh,
			'actividades'=>$actividades,
			'idvehiculo'=>$idvehiculo,
			'recursos'=>$recursos,
			'orden'=>$orden,
		),true));
		 $mPDF1->Output('Orden-'.$id.'.pdf','D');
		 exit;
	}	 
	public function actionVistaPrevia($id,$nom,$dir){
		$tipo=-1;
		$detAnt=0;
		if(isset($_GET["idRepAnt"])){
			$detAnt=$_GET["idRepAnt"];
		}

		$orden=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'id='.$id."")
			,'pagination'=>array('pageSize'=>9999999)));
			
		$idvehiculo=Yii::app()->db->createCommand("select distinct( a.idvehiculo), count(*) as totAct from sgu_reporteFalla a, sgu_detalleOrdenCo d where d.idreporteFalla=a.id and d.idordenMtto=".$id." group by a.idvehiculo")->queryAll();
		$totalVeh=count($idvehiculo);
		
		//$actividades=Yii::app()->db->createCommand("select idactividades from sgu_detalleorden where idordenMtto=".$id."")->queryAll();
		
		for($i=0;$i<$totalVeh;$i++){
			$vehiculos[]=new CActiveDataProvider('Vehiculo',array('criteria' => array(
			'condition' =>'id="'.$idvehiculo[$i]["idvehiculo"].'"',
			)));
			
		$totAct=Yii::app()->db->createCommand('select idreporteFalla as id from sgu_detalleOrdenCo where idordenMtto="'.$id.'" and idreporteFalla in(select a.id from sgu_reporteFalla a where a.idvehiculo="'.$idvehiculo[$i]["idvehiculo"].'")')->queryAll();
		
		for($j=0;$j<$idvehiculo[$i]["totAct"];$j++){		
				$actividades[$i][$j]=new CActiveDataProvider('Reportefalla',array('criteria' => array(
				'condition' =>'id="'.$totAct[$j]["id"].'"',
				)));
				$recursos[$i][$j]=new CActiveDataProvider('Recursofalla',array('criteria' => array(
				'condition' =>'idreporteFalla="'.$totAct[$j]["id"].'"',
				)));
			}
		}
		$totFactura=Yii::app()->db->createCommand('select (round(sum(ar.costoTotal),2)) as Total from sgu_recursoFalla ar, sgu_detalleOrdenCo d where d.idreporteFalla=ar.idreporteFalla and d.idordenMtto="'.$id.'"')->queryRow();
		

		$factura=new CActiveDataProvider('Factura',array('criteria' => array(
			'condition'=>'idordenMtto="'.$id.'"'),
			'pagination'=>array('pageSize'=>9999999)));
		
		$det=new CActiveDataProvider('Reportefalla',array('criteria' => array(
				'condition' =>'id="0"')));
		
		$detRepuesto=new CActiveDataProvider('Cantidad',array('criteria' => array(
			'condition' =>"id=0",
			'order'=>'id')));
		if(isset($_GET["idRep"])){
			$recursofalla = Recursofalla::model()->findByPk($_GET["idRep"]);
			
			$Actividades = Reportefalla::model()->findByPk($recursofalla->idreporteFalla);
			$consulta=Yii::app()->db->createCommand("select * from sgu_CaracteristicaVeh where idvehiculo=".$Actividades->idvehiculo." and idrepuesto='".$recursofalla->idrepuesto."'")->queryRow();
			if(count($consulta)==0)
				$tieneAsignado=0;
			else
			$detRepuesto=new CActiveDataProvider('Cantidad',array('criteria' => array(
			'condition' =>"idCaracteristicaVeh = '".$consulta['id']."' and (estado=0 or estado=1 or estado=3)",
			'order'=>'id')));

		}
		if(isset($_GET["idAct"])){
			$det=new CActiveDataProvider('Reportefalla',array('criteria' => array(
				'condition' =>'id='.$_GET["idAct"].'',
				)));
		}
		if(isset($_GET["idTipo"])){
			$tipo=$_GET["idTipo"];
		}
		$detAnterior=new CActiveDataProvider('Cantidad',array('criteria' => array(
		'condition' =>"id = '".$detAnt."'",
		'order'=>'id')));

		$this->render('vistaPrevia',array(
			'tipo'=>$tipo,
			'vehiculos'=>$vehiculos,
			'det'=>$det,
			'totalVeh'=>$totalVeh,
			'actividades'=>$actividades,
			'idvehiculo'=>$idvehiculo,
			'recursos'=>$recursos,
			'orden'=>$orden,
			'factura'=>$factura,
			'totFactura'=>$totFactura,
			'detAnterior'=>$detAnterior,
			'detRepuesto'=>$detRepuesto,
			'nom'=>$nom,
			'dir'=>$dir,
			'idOrden'=>$id,
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
		));
	
	}
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionCambiarFecha($id){
		if(isset($_POST['fecha'])){
			Yii::app()->db->createCommand("update `tsg`.`sgu_actividades` set `proximoFecha` = '".$_POST['fecha']."' where `sgu_actividades`.`id` = ".$id."")->query();
		}
	}
	public function actionCalendario(){
	$act=Yii::app()->db->createCommand("select concat('Unidad ',v.numeroUnidad ,'=>',am.actividad) as titulo, a.proximoFecha, a.id, a.idestatus, a.fechaRealizada from sgu_actividadMtto am, sgu_actividades a, sgu_vehiculo v where a.idvehiculo=v.id and  am.id=a.idactividadMtto")->queryAll();
    $tot=count($act);
	for($i=0;$i<$tot;$i++){
	if($act[$i]["idestatus"]==3){
		$color='#21831B';
		$editable=false;
		$fecha=$act[$i]["fechaRealizada"];
	}
	else{
		$fecha=$act[$i]["proximoFecha"];
		$color='#CC0000';
		$editable=true;
	}
	$items[]=array(
		'id'=>$act[$i]["id"],
        'title'=>$act[$i]["titulo"],
        'start'=>$fecha,
        'color'=>$color,
        'allDay'=>true,
        //'url'=>'',
		'editable'=>$editable,
		'selectable' => true,
    );}
	$this->render('calendar',array(
		'items'=>$items
	));
    //echo CJSON::encode($items);
    //Yii::app()->end();
}
	/*public function actionCalendario(){
		
		$this->render('calendar');
	}*/
	public function getOrdenesAbiertas(){
		$abiertas=Yii::app()->db->createCommand("select count(*) as total from sgu_ordenMtto where idestatus=5 and tipo=1")->queryRow();
		return $abiertas["total"];
	}
	public function getOrdenesListas(){
		$abiertas=Yii::app()->db->createCommand("select count(*) as total from sgu_ordenMtto where idestatus=6 and tipo=1")->queryRow();
		return $abiertas["total"];
	}
	public function getColor($tot){
		if($tot>0)
			return $color='important';
		else	
			return $color='';
	}
	public function getActividadAtraso($id){
	
			$atraso=Yii::app()->db->createCommand("select DATEDIFF(CURDATE(),proximoFecha) as atraso from sgu_actividades where id=".$id."")->queryRow();
			return $atraso["atraso"];
	}
	public function actionCerrarOrdenes(){
		$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'id in (select id from sgu_ordenMtto where idestatus=6 and tipo=1)',
			'order'=>'fecha'
			)));
		$this->render('cerrarOrdenes',array(
			'dataProvider'=>$dataProvider,
			'mi'=>$this->getFallas(),
			'color'=>$this->getColor($this->getFallas()),
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
			));
	}
	public function actionVerOrdenes(){
		$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'id in (select id from sgu_ordenMtto where (idestatus=5 or idestatus=6) and tipo=1)',
			'order'=>'id desc'
			)));
		$this->render('verOrdenes',array(
			'dataProvider'=>$dataProvider,
			'mi'=>$this->getFallas(),
			'color'=>$this->getColor($this->getFallas()),
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
			));
	}
	public function actionAgregarFactura($id){
		$model=new Factura;
				$fecha=Ordenmtto::model()->findByPk($id);
				$fecha=date("Y-m-d", strtotime(str_replace('/', '-',$fecha->fecha)));
				$intervalo=((strtotime(date("Y-m-d"))-strtotime($fecha))/86400);
			
		if(isset($_POST['Factura'])){
            $model->attributes=$_POST['Factura'];
            if($model->fechaFactura<>null)
			$model->fechaFactura=date("Y-m-d", strtotime(str_replace('/', '-',$model->fechaFactura )));
            if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
				  
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Información de factura agregado"
                        ));
					exit;
                }
            }
        }
		 if (Yii::app()->request->isAjaxRequest){	
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formFactura', array('model'=>$model,'id'=>$id,'intervalo'=>$intervalo), true)
				));
            exit;               
        }
	}
	public function actionRegistrarFacturacion($id,$nom,$dir){
		$model = new Factura;
		$idrecurso=0;
		$detAnt=0;
		if(isset($_GET['idAct'])){	
			$idrecurso=$_GET['idAct'];
		}
		$recurso=new CActiveDataProvider('Recursofalla',array('criteria'=>array('condition'=>'idreporteFalla="'.$idrecurso.'"')));
		$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
			'condition' =>'id in (select idreporteFalla from sgu_detalleOrdenCo where idordenMtto="'.$id.'") and idfalla in (select id from sgu_falla where tipo=0)',
			
			'order'=>'fechaFalla DESC'
			
			)));
			$mejoras=new CActiveDataProvider('Reportefalla',array('criteria' => array(
			'condition' =>'id in (select idreporteFalla from sgu_detalleOrdenCo where idordenMtto="'.$id.'") and idfalla in (select id from sgu_falla where tipo=1)',
			
			'order'=>'fechaFalla DESC'
			
			)));
			
		$factura=new CActiveDataProvider('Factura',array('criteria' => array(
			'condition'=>'idordenMtto="'.$id.'"'),
			'pagination'=>array('pageSize'=>9999999)));
		$tot=Yii::app()->db->createCommand('select * from sgu_factura where idordenMtto="'.$id.'"')->queryAll();
		$total=count($tot);
		$orden=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'id='.$id."")
			,'pagination'=>array('pageSize'=>9999999)));
		$fechaOrden=$orden->getData();
		$fechaOrden=date("Y-m-d", strtotime($fechaOrden[0]["fecha"]));		
		$dias=((strtotime(date("Y-m-d"))-strtotime($fechaOrden))/86400);
		
		$det=new CActiveDataProvider('Cantidad',array('criteria' => array(
			'condition' =>"id=0")));
		
		if(isset($_GET["idRep"])){
			$recursofalla = Recursofalla::model()->findByPk($_GET["idRep"]);
			
			$Actividades = Reportefalla::model()->findByPk($recursofalla->idreporteFalla);
			$consulta=Yii::app()->db->createCommand("select * from sgu_CaracteristicaVeh where idvehiculo=".$Actividades->idvehiculo." and idrepuesto='".$recursofalla->idrepuesto."'")->queryRow();
			if(count($consulta)==0)
				$tieneAsignado=0;
			else
			$det=new CActiveDataProvider('Cantidad',array('criteria' => array(
			'condition' =>"idCaracteristicaVeh = '".$consulta['id']."' and (estado=0 or estado=1 or estado=3)",
			'order'=>'id')));

		}
		if(isset($_GET["idRepAnt"])){
			$detAnt=$_GET["idRepAnt"];
		}
		$detAnterior=new CActiveDataProvider('Cantidad',array('criteria' => array(
		'condition' =>"id = '".$detAnt."'",
		'order'=>'id')));

		$this->render('registrarFacturacion',array(
			'dataProvider'=>$dataProvider,
			'mejoras'=>$mejoras,
			'modelofactura'=>$model,
			'factura'=>$factura,
			'id'=>$id,
			'recurso'=>$recurso,
			'total'=>$total,
			'nom'=>$nom,
			'dir'=>$dir,
			'model'=> new Reportefalla,
			'dias'=>$dias,
			'det'=>$det,
			'detAnterior'=>$detAnterior,
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
		));
	}
	public function actionCrearOrden(){
		$model=new Ordenmtto;
		if(isset($_POST['Ordenmtto'])){
            $model->attributes=$_POST['Ordenmtto'];
            if($model->save()){
			if(isset($_POST['idfalla'])){
				if($_POST['idfalla']!=""){
					$fal = explode(",", $_POST['idfalla']);
					foreach($fal as $idfal){
						/*cambio el estado a en mtto*/
						$act = Reportefalla::model()->findByPk($idfal);
						$vehiculo = Vehiculo::model()->findByPk($act->idvehiculo);
						$vehiculo->activo=3;
						$vehiculo->update();
						$vehiculo->setEstado(3,'Mantenimiento correctivo');
						/**/
						Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_detalleOrdenCo` (`idreporteFalla`,`idordenMtto`) VALUES (".$idfal.",".$model->id.")")->query();
						Yii::app()->db->createCommand("update `tsg`.`sgu_reporteFalla` set `idestatus` = '4' where `sgu_reporteFalla`.`id` = ".$idfal."")->query();
					}
				}
			}
			if(isset($_POST['idmejora'])){
				if($_POST['idmejora']!=""){
					$fal = explode(",", $_POST['idmejora']);
					foreach($fal as $idmej){
						/*cambio estado*/
						$act = Reportefalla::model()->findByPk($idmej);
						$vehiculo = Vehiculo::model()->findByPk($act->idvehiculo);
						$vehiculo->activo=3;
						$vehiculo->update();
						$vehiculo->setEstado(3,'Mantenimiento correctivo');
						/**/
						Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_detalleOrdenCo` (`idreporteFalla`,`idordenMtto`) VALUES (".$idmej.",".$model->id.")")->query();
						Yii::app()->db->createCommand("update `tsg`.`sgu_reporteFalla` set `idestatus` = '4' where `sgu_reporteFalla`.`id` = ".$idmej."")->query();
					}
				}
			}
                if (Yii::app()->request->isAjaxRequest){
				   /*inserts por debajo del plan de mantenimiento a cada vehiculo del grupo*/
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se creo la orden de mantenimiento"
                        ));
					exit;
                }
            }
        }
		 if (Yii::app()->request->isAjaxRequest){	
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formCrearOrden', array('model'=>$model), true)
				));
            exit;               
        }
	}
	public function actionCrearOrdenCorrectiva(){
		
		$modeloOrdenMtto=new Ordenmtto;
		$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
			//'condition' =>'idestatus=2 and atraso >=-5',
			'condition' =>'idestatus=8 and idfalla in (select id from sgu_falla where tipo=0)',
			'order'=>'fechaFalla'
			),
				'pagination'=>array(
        		'pageSize'=>5,
    		)));
		$mejoras=new CActiveDataProvider('Reportefalla',array('criteria' => array(
			//'condition' =>'idestatus=2 and atraso >=-5',
			'condition' =>'idestatus=8 and idfalla in (select id from sgu_falla where tipo=1)',
			'order'=>'fechaFalla'
			),			
				'pagination'=>array(
        		'pageSize'=>5,
    		)
		));
		$this->render('crearOrdenCorrectiva',array(
			'dataProvider'=>$dataProvider,
			'mejoras'=>$mejoras,
			'mi'=>$this->getFallas(),
			'color'=>$this->getColor($this->getFallas()),
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
		));
	}
	public function actionMttopVehiculo($id){
	
		$dataProvider=new CActiveDataProvider('Actividades',array('criteria' => array(
			'order'=>'proximoFecha asc',
			'condition' =>'idvehiculo="'.$id.'" and idestatus<>1 and idestatus<>3')
			,'pagination'=>array('pageSize'=>9999999)));
			
		$mi=Yii::app()->db->createCommand("select count(*) as total from sgu_actividades where idestatus=1 and idvehiculo=".$id."")->queryRow();
		$this->render('mttopVehiculo',array(
			'id'=>$id,
			'dataProvider'=>$dataProvider,
			'mi'=>$mi["total"],
			'color'=>$this->getColor($mi["total"]),
			
		));
	}
	public function actionEstatusOrden($id){
		if($id==1)
			Yii::app()->db->createCommand("update `tsg`.`sgu_ordenMtto` set `idestatus` = '6' where `sgu_ordenMtto`.`id` = ".$_POST['id']."")->query();
		if($id==0)	
			Yii::app()->db->createCommand("update `tsg`.`sgu_ordenMtto` set `idestatus` = '5' where `sgu_ordenMtto`.`id` = ".$_POST['id']."")->query();
		if($id==7){
			$actividades=Detalleordenco::model()->findAll(array("condition"=>"idordenMtto = '".$_POST['id']."'"));
			for($i=0;$i<count($actividades);$i++){
				$vehiculo=Reportefalla::model()->find(array("condition"=>"id = '".$actividades[$i]["idreporteFalla"]."'"));
				/*cambio estatus a activo al cerrar la orden*/
					$veh = Vehiculo::model()->findByPk($vehiculo["idvehiculo"]);
					$vehiculo->activo=1;
					$vehiculo->update();
					$veh->setEstado(1,'Mantenimiento correctivo realizado');

				/**/
				$recursos=Recursofalla::model()->findAll(array("condition"=>"idreporteFalla = '".$actividades[$i]["idreporteFalla"]."'"));
				for($j=0;$j<count($recursos);$j++){
					if($recursos[$j]["idrepuesto"]<>null){
						$repuestos=Cantidad::model()->findAll(array("condition"=>"estado=3 and idCaracteristicaVeh in (select id from sgu_CaracteristicaVeh where idrepuesto= '".$recursos[$j]["idrepuesto"]."' and idvehiculo = '".$vehiculo["idvehiculo"]."')"));						
						foreach ($repuestos as $rep) {
							$rep->estado=1;
							$rep->update();
						}
					}
				}
			}

			Yii::app()->db->createCommand("update `tsg`.`sgu_ordenMtto` set `idestatus` = '7' where `sgu_ordenMtto`.`id` = ".$_POST['id']."")->query();
		}	
	}
	public function actionIniciales(){
		$dataProvider=new CActiveDataProvider('Actividades',array('criteria' => array(
		'order'=>'proximoFecha asc',
		'condition' =>'idestatus <>3'),
		'pagination'=>array('pageSize'=>9999999)));
			$this->render('iniciales',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function actionMttocRealizados($id,$nom,$dir){
		$orden=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'id='.$id."")
			,'pagination'=>array('pageSize'=>9999999)));
		$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
			'condition' =>'id in (select idreporteFalla from sgu_detalleOrdenCo where idordenMtto="'.$id.'") and idfalla in (select id from sgu_falla where tipo=0)',
			
			'order'=>'fechaFalla DESC'
			
			)));
			$mejoras=new CActiveDataProvider('Reportefalla',array('criteria' => array(
			'condition' =>'id in (select idreporteFalla from sgu_detalleOrdenCo where idordenMtto="'.$id.'") and idfalla in (select id from sgu_falla where tipo=1)',
			
			'order'=>'fechaFalla DESC'
			
			)));
		$this->render('mttocRealizados',array(
			'dataProvider'=>$dataProvider,
			'orden'=>$orden,
			'id'=>$id,
			'nom'=>$nom,
			'dir'=>$dir,
			'mejoras'=>$mejoras,
			'idOrden'=>$id,
	 
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
		));
	}
	public function actionActualizarCheck($id){
		$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
			'order'=>'fechaFalla asc',
			'condition'=>'id in (select idreporteFalla from sgu_detalleOrdenCo where idordenMtto="'.$id.'")')
			,'pagination'=>array('pageSize'=>9999999)));
		$fac=Yii::app()->db->createCommand('select total from sgu_factura where idordenMtto="'.$id.'"')->queryRow();
                   
		$data=$dataProvider->getData();
		for($i=0;$i<count($data);$i++){
			//if($data[$i]["fechaRealizada"]=="0000-01-01" or $data[$i]["kmRealizada"]==-1){

			if($data[$i]["idestatus"]<>3 or $fac["total"]==0){
				$estado=0;
				break;
			}else	
				$estado=1;
		}
		  echo CJSON::encode(array(
                'estado'=>$estado, 
                ));
			exit;
	}
	public function actionMttopIniciales($id){
		$dataProvider=new CActiveDataProvider('Actividades',array('criteria' => array(
			'order'=>'proximoFecha asc',
			'condition' =>'idvehiculo="'.$id.'" and idestatus <>3 ')
			,'pagination'=>array('pageSize'=>9999999)));
		$this->render('mttopIniciales',array(
			'id'=>$id,
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 	public function actionAgregarRecursoAdicional($id){
                $model=new Recursofalla;
				$tipoInsumo=new Tipoinsumo();
				$tipoRepuesto=new Subtiporepuesto();
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
	 
    if(isset($_POST['Recursofalla'])){
            $iva=Parametro::model()->findByAttributes(array('nombre'=>'IVA'));
            $model->attributes=$_POST['Recursofalla'];
            $model->iva=$iva["valor"]/100;
            if($model->save()){
            		if(isset($_POST['idfac'])){
						$factura=Factura::model()->findByPk($_POST['idfac']);
						$actividades=Detalleordenco::model()->findAll(array("condition"=>"idordenMtto = '".$factura->idordenMtto."'"));
						$subTotal=0;
						for($i=0;$i<count($actividades);$i++){
							$recursos=Recursofalla::model()->findAll(array("condition"=>"idreporteFalla = '".$actividades[$i]["idreporteFalla"]."'"));
							for($j=0;$j<count($recursos);$j++){
								$subTotal+=$recursos[$j]["costoTotal"];
							}
						}
						Yii::app()->db->createCommand("update `tsg`.`sgu_factura` set `total`=".$subTotal." where `sgu_factura`.`id` = ".$_POST['idfac']."")->query();
						$factura=Factura::model()->findByPk($_POST['idfac']);
						Yii::app()->db->createCommand("update `tsg`.`sgu_factura` set `iva`=".(($factura->total)*($iva["valor"]/100)).",`totalFactura`=".(($factura->total)+($factura->total)*($iva["valor"]/100))."   where `sgu_factura`.`id` = ".$_POST['idfac']."")->query();
					}
                if (Yii::app()->request->isAjaxRequest){
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se agregó el recurso correctamente"
                        ));
                    exit;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formRecursoAdicional', array('model'=>$model,'id'=>$id,'tipoInsumo'=>$tipoInsumo,'tipoRepuesto'=>$tipoRepuesto), true)));
            exit;               
        }
        /*else
            $this->render('create',array('model'=>$model,));*/
	}
	
	public function actionAgregarRecurso($id){
                $model=new Actividadrecursogrupo;
				$tipoInsumo=new Tipoinsumo();
				$tipoRepuesto=new Subtiporepuesto();
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
 
    if(isset($_POST['Actividadrecursogrupo'])){
			$null='NULL';
            $model->attributes=$_POST['Actividadrecursogrupo'];
            if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
				   /*inserts por debajo del plan de mantenimiento a cada vehiculo del grupo*/
				   $totalAct=Yii::app()->db->createCommand('select id from sgu_actividades where idactividadesGrupo="'.$id.'" and idestatus<>3')->queryAll();
                    $total=count($totalAct);
				for($i=0;$i<$total;$i++){
					Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_actividadRecurso` (`cantidad`,`idactividades`,`idinsumo`,`idrepuesto`,`idservicio`,`idunidad`,`detalle`,`idactividadRecursoGrupo`)
						VALUES (".$model->cantidad.",".$totalAct[$i]["id"].",".($model->idinsumo==null?$null:$model->idinsumo).",".($model->idrepuesto==null?$null:$model->idrepuesto).",".($model->idservicio==null?$null:$model->idservicio).",".$model->idunidad.",'".$model->detalle."',".$model->id.")")->query();
					}
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se agregó el recurso correctamente"
                        ));
                    exit;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formRecursoGrupo', array('model'=>$model,'id'=>$id,'tipoInsumo'=>$tipoInsumo,'tipoRepuesto'=>$tipoRepuesto), true)));
            exit;               
        }
        /*else
            $this->render('create',array('model'=>$model,));*/
	}
	public function actionAgregarActividad($id){
                $model=new Actividadesgrupo;
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
 
    if(isset($_POST['Actividadesgrupo'])){
            $model->attributes=$_POST['Actividadesgrupo'];
            if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
				   /*inserts por debajo de la actividad a cada vehiculo del grupo*/
				$totalVeh=Yii::app()->db->createCommand('select id from sgu_vehiculo where idgrupo="'.$id.'"')->queryAll();
				$total=count($totalVeh);
				for($i=0;$i<$total;$i++){
					Yii::app()->db->createCommand("INSERT  INTO `tsg`.`sgu_actividades` (`idactividadMtto`,`frecuenciaKm`,`frecuenciaMes`,`duracion`,`idprioridad`,`idvehiculo`,`idtiempod`,`idtiempof`,`idactividadesGrupo`,`idestatus`,`procedimiento`)
					VALUES (".$model->idactividadMtto.",".$model->frecuenciaKm.",".$model->frecuenciaMes.",".$model->duracion.",".$model->idprioridad.",".$totalVeh[$i]["id"].",".$model->idtiempod.",".$model->idtiempof.",".$model->id.",1,'".$model->procedimiento."')")->query();
				}
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se agregó la actividad correctamente"
                        ));
                    exit;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formActGrupo', array('model'=>$model,'id'=>$id), true)));
            exit;               
        }
        /*else
            $this->render('create',array('model'=>$model,));*/
	}
	/*public function actionObtenerParte($id){
		$parte=Yii::app()->db->createCommand('select concat_ws(" / ",(select parte from sgu_plangrupo c1 where c1.id=c2.idplanGrupo),c2.parte) as parte from 	sgu_plangrupo c2
		where c2.id="'.$id.'"')->queryRow();
		echo $parte["parte"];
	}*/
	public function actionObtenerActividad($id){
		$parte=Yii::app()->db->createCommand('select am.actividad from sgu_actividadMtto am, sgu_actividadesGrupo ag where ag.idactividadMtto=am.id and ag.id="'.$id.'"')->queryRow();
		echo $parte["actividad"];
	}

public function actionRegistroIncidente2(){
	$model=new Reportefalla;
    if(isset($_POST['Reportefalla'])){
        $model->attributes=$_POST['Reportefalla'];
		$model->fechaFalla=date("Y-m-d", strtotime(str_replace('/', '-',$model->fechaFalla )));
        if($model->save()){
            if (Yii::app()->request->isAjaxRequest){
				echo CJSON::encode(array(
                    'status'=>'success', 
                    'mensaje'=>'<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
                        <b>El incidente se registró correctamente</b>
                        </div>'
                    ));
                }
                return true;
            }else{
                echo CJSON::encode(array(
                'status'=>'failure', 
                'mensaje'=>'Error, verifique la información'
            ));
                return false;
        }
    }
}
	public function actionFalla(){
		
		$model=new Reportefalla;
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
 
    if(isset($_POST['Reportefalla'])){
			
            $model->attributes=$_POST['Reportefalla'];
			$model->fechaFalla=date("Y-m-d", strtotime(str_replace('/', '-',$model->fechaFalla)));
            if($model->save()){
            	/*si registro una falla cambio el estado del vehiculo*/			
					$vehiculo = Vehiculo::model()->findByPk($model->idvehiculo);
					$vehiculo->activo=2;
					$vehiculo->update();
					$vehiculo->setEstado(2,'Vehiculo averiado');
					/**/
                if (Yii::app()->request->isAjaxRequest){
			
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'mensaje'=>'<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
                            <b>El incidente se registró correctamente</b>
                        	</div>'
                        ));
                    exit;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formReporteFalla', array('model'=>$model), true)));
            exit;               
        }
	}
	public function actionMejora(){
		
		$model=new Reportefalla;
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
 
    if(isset($_POST['Reportefalla'])){
			
            $model->attributes=$_POST['Reportefalla'];
			$model->fechaFalla=date("Y-m-d", strtotime(str_replace('/', '-',$model->fechaFalla )));
            if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
				   /*inserts por debajo del plan de mantenimiento a cada vehiculo del grupo*/
				   
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'mensaje'=>'<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
                            <b>La mejora se registró correctamente</b>
                        	</div>'
                        ));
                    exit;
                }
            }
			
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formReporteMejora', array('model'=>$model), true)));
            exit;               
        }
	}
	public function actionRegistrarFalla(){
		$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
			'condition' =>'t.idestatus=8 and t.idfalla in (select a.id from sgu_falla a where a.tipo =0)',
			'order'=>'fechaFalla DESC'
			)));
		$this->render('registrarFalla',array(
			'dataProvider'=>$dataProvider,
			'mi'=>$this->getFallas(),
			'color'=>$this->getColor($this->getFallas()),
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
		));
	}
	public function actionRegistrarMejora(){
		$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
			'condition' =>'idestatus=8 and idfalla in (select id from sgu_falla where tipo =1)',
			'order'=>'fechaFalla DESC'
			)));
		$this->render('registrarMejora',array(
			'dataProvider'=>$dataProvider,
			'mi'=>$this->getFallas(),
			'color'=>$this->getColor($this->getFallas()),
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
			
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
		$tipo = new Tiporepuesto;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Repuesto']))
		{
			$model->attributes=$_POST['Repuesto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'tipo'=>$tipo,
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
	public function actionHistoricoGastos(){
		$vehiculo = new Vehiculo;	
		$dataProvider=new CActiveDataProvider('Recursofalla',array('criteria'=>array('condition'=>'costoTotal>0')));
		if(isset($_GET["fechaIni"]) or isset($_GET["fechaFin"]) or isset($_GET["vehiculo"])){
				if($_GET["fechaIni"]=="" and $_GET["fechaFin"]=="" and $_GET["vehiculo"]==""){
					$dataProvider=new CActiveDataProvider('Recursofalla',array('criteria' => array(
						'condition' =>'costoTotal>0',
						'order'=>'id',
					)));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]==""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					$dataProvider=new CActiveDataProvider('Recursofalla',array('criteria' => array(
						'condition' =>'costoTotal>0 and idreporteFalla in (select id from sgu_reporteFalla where idestatus = 3 and fechaRealizada>="'.$fechaini.'" and fechaRealizada<="'.$fechafin.'")',
						//'order'=>'fechaRealizada',
					)));		
				}
				if($_GET["fechaIni"]=="" and $_GET["vehiculo"]!=""){
					
					$dataProvider=new CActiveDataProvider('Recursofalla',array('criteria' => array(
						'condition' =>'costoTotal>0 and idreporteFalla in (select id from sgu_reporteFalla where idestatus = 3 and idvehiculo='.$_GET["vehiculo"].')',
						'order'=>'id',
					)));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]!=""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					
					$dataProvider=new CActiveDataProvider('Recursofalla',array('criteria' => array(
						'condition' =>'costoTotal>0 and idreporteFalla in (select id from sgu_reporteFalla where idestatus = 3 and fechaRealizada>="'.$fechaini.'" and fechaRealizada<="'.$fechafin.'" and idvehiculo='.$_GET["vehiculo"].') ',
						//'order'=>'fechaRealizada',
					)));	
				}
			}
		$this->render('historicoGastos',array(
			'dataProvider'=>$dataProvider,
			'mi'=>$this->getFallas(),
			'color'=>$this->getColor($this->getFallas()),
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
			'vehiculo'=>$vehiculo,
		));
	}
		public function actionHistoricoMejoras(){
	//idplan in (select id from sgu_plan) and ??
			$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
				'condition' =>'idestatus=3 and tipo=1',
				'order'=>'fechaRealizada'
			)));
			if(isset($_GET["fechaIni"]) or isset($_GET["fechaFin"]) or isset($_GET["vehiculo"])){
				if($_GET["fechaIni"]=="" and $_GET["fechaFin"]=="" and $_GET["vehiculo"]==""){
					$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
						'condition' =>'idestatus=3 and tipo=1',
						'order'=>'fechaRealizada',
					)));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]==""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
						'condition' =>'idestatus=3 and tipo=1 and (fechaRealizada>="'.$fechaini.'" and fechaRealizada<="'.$fechafin.'")',
						'order'=>'fechaRealizada',
					)));		
				}
				if($_GET["fechaIni"]=="" and $_GET["vehiculo"]!=""){
					
					$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
						'condition' =>'idestatus=3 and tipo=1 and idvehiculo='.$_GET["vehiculo"].'',
						'order'=>'fechaRealizada',
					)));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]!=""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
						'condition' =>'idestatus=3 and tipo=1 and (fechaRealizada>="'.$fechaini.'" and fechaRealizada<="'.$fechafin.'") and idvehiculo='.$_GET["vehiculo"].'',
						'order'=>'fechaRealizada',
					)));	
				}
			}
		$this->render('historicoMejoras',array(
				'dataProvider'=>$dataProvider,
				'mi'=>$this->getFallas(),
			'color'=>$this->getColor($this->getFallas()),
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
			));
	}
	public function actionHistoricoCorrectivo(){
	//idplan in (select id from sgu_plan) and ??
			$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
				'condition' =>'idestatus=3  and tipo=0',
				'order'=>'fechaRealizada'
			)));
			if(isset($_GET["fechaIni"]) or isset($_GET["fechaFin"]) or isset($_GET["vehiculo"])){
				if($_GET["fechaIni"]=="" and $_GET["fechaFin"]=="" and $_GET["vehiculo"]==""){
					$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
						'condition' =>'idestatus=3 and tipo=0',
						'order'=>'fechaRealizada',
					)));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]==""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
						'condition' =>'idestatus=3 and tipo=0 and (fechaRealizada>="'.$fechaini.'" and fechaRealizada<="'.$fechafin.'")',
						'order'=>'fechaRealizada',
					)));		
				}
				if($_GET["fechaIni"]=="" and $_GET["vehiculo"]!=""){
					
					$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
						'condition' =>'idestatus=3 and tipo=0 and idvehiculo='.$_GET["vehiculo"].'',
						'order'=>'fechaRealizada',
					)));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]!=""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
						'condition' =>'idestatus=3 and tipo=0 and (fechaRealizada>="'.$fechaini.'" and fechaRealizada<="'.$fechafin.'") and idvehiculo='.$_GET["vehiculo"].'',
						'order'=>'fechaRealizada',
					)));	
				}
			}
		$this->render('historicoCorrectivo',array(
				'dataProvider'=>$dataProvider,
				'mi'=>$this->getFallas(),
			'color'=>$this->getColor($this->getFallas()),
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
			));
	}
	public function getFallas(){
		$mi=Yii::app()->db->createCommand("select count(*) as total from sgu_reporteFalla where idestatus=8  and idfalla in (select id from sgu_falla where tipo = 0)")->queryRow();
		return $mi["total"];
	}
	public function actionHistoricoOrdenes(){
	$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'idestatus=7 and tipo=1',
			'order'=>'fecha')));
			
			if(isset($_GET["fechaIni"]) or isset($_GET["fechaFin"]) or isset($_GET["vehiculo"])){
				if($_GET["fechaIni"]=="" and $_GET["fechaFin"]=="" and $_GET["vehiculo"]==""){
					$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
						'condition' =>'idestatus=7 and tipo=1',
						'order'=>'fecha')));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]==""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
						'condition' =>'idestatus=7 and tipo=1 and (fecha>="'.$fechaini.'" and fecha<="'.$fechafin.'")',
						'order'=>'fecha',
					)));		
				}
				if($_GET["fechaIni"]=="" and $_GET["vehiculo"]!=""){
					
					$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
						'condition' =>'idestatus=7 and tipo=1 and id in (select idordenMtto from sgu_detalleOrdenCo where idreporteFalla in (select id from sgu_reporteFalla where idvehiculo='.$_GET["vehiculo"].'))',
						'order'=>'fecha',
					)));	
				}
				if($_GET["fechaIni"]!="" and $_GET["vehiculo"]!=""){
					$fechaini=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaIni"])));
					$fechafin=date("Y-m-d", strtotime(str_replace('/', '-',$_GET["fechaFin"])));
					$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
						'condition' =>'idestatus=7 and tipo=1 and (fecha>="'.$fechaini.'" and fecha<="'.$fechafin.'") and id in (select idordenMtto from sgu_detalleOrdenCo where idreporteFalla in (select id from sgu_reporteFalla where idvehiculo='.$_GET["vehiculo"].'))',
						'order'=>'fecha',
					)));	
				}
			}
		$this->render('historicoOrdenes',array(
			'dataProvider'=>$dataProvider,'mi'=>$this->getFallas(),
			'color'=>$this->getColor($this->getFallas()),
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
			));
	}
	public function actionIndex(){
			$cond='idestatus=8 and idfalla in (select id from sgu_falla where tipo = 0)';
			if(isset($_GET["filtro"])){
				if($_GET["filtro"]==1)
					$cond='idestatus=8  and idfalla in (select id from sgu_falla where tipo = 0)';
				if($_GET["filtro"]==2)
					$cond='idestatus=4  and idfalla in (select id from sgu_falla where tipo = 0)';
				if($_GET["filtro"]==3)
					$cond='idestatus=3  and idfalla in (select id from sgu_falla where tipo = 0)';
				if($_GET["filtro"]==4){
					$cond='1  and idfalla in (select id from sgu_falla where tipo = 0)';
				}
			}
			$dataProvider=new CActiveDataProvider('Reportefalla',array('criteria' => array(
			'condition' =>$cond,
			'order'=>'fechaFalla DESC'
			)));
			
			
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'mi'=>$this->getFallas(),
			'color'=>$this->getColor($this->getFallas()),
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
			));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Repuesto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Repuesto']))
			$model->attributes=$_GET['Repuesto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Repuesto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Repuesto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Repuesto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='repuesto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionNuevaFalla() {
		$model=new Falla;
		if(isset($_POST['Falla'])){
            $model->attributes=$_POST['Falla'];
			if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"registro agregado"
                        ));
					exit;
                }
            }
        }
		 if (Yii::app()->request->isAjaxRequest){	
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formNuevaFalla', array('model'=>$model), true)
				));
            exit;               
        }
		
	}
	public function actionNuevaMejora() {
		$model=new Falla;
		if(isset($_POST['Falla'])){
			
            $model->attributes=$_POST['Falla'];
			
			if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Mejora agregada"
                        ));
					exit;
                }
            }
        }
		 if (Yii::app()->request->isAjaxRequest){	
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formNuevaMejora', array('model'=>$model), true)
				));
            exit;               
        }
		
	}
	public function actionAjaxActualizarListaFallas(){
		
		$models = Falla::model()->findAll('tipo=0 order by id DESC');
		foreach ($models as $mode){
			echo CHtml::tag('option',array('type'=>'text','value'=>(($mode->id))),Chtml::encode(($mode->falla)),true);
		}
	}
	public function actionAjaxActualizarListaMejora(){
		
		$models = Falla::model()->findAll('tipo=1 order by id DESC');
		foreach ($models as $mode){
			echo CHtml::tag('option',array('type'=>'text','value'=>(($mode->id))),Chtml::encode(($mode->falla)),true);
		}
	}
	public function actionAjaxObtenerConductor($id){
			if($id==0)
				return  CHtml::tag('option',array('type'=>'text','value'=>((''))),Chtml::encode(('')),true);
			
	$lista2=Historicoempleados::model()->findAll('idvehiculo = '.$id.' and idempleado in (select id from sgu_empleado where idtipoEmpleado=1) order by id desc limit 1');
			
			$mi=Yii::app()->db->createCommand("select id, concat(nombre,' ',apellido) as nombre from sgu_empleado where idtipoEmpleado=1 order by id=".$lista2[0]['idvehiculo']." desc")->queryAll();
			
			foreach($mi as $li){
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li['id']))),Chtml::encode(($li["nombre"])),true);
			}
	}
}
