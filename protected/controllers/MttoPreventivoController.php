<?php

class MttoPreventivoController extends Controller
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
				'actions'=>array('index','view','crearPlan','planes','agregarActividad','obtenerParte','mttopVehiculo','mttopIniciales','calendario','obtenerActividad','agregarRecurso','iniciales','crearordenpreventiva','crearOrden','verOrdenes','cambiarFecha','mttopRealizados','registrarFacturacion','agregarFactura','estatusOrden','cerrarOrdenes','historicoPreventivo','historicoOrdenes','historicoGastos','vistaPrevia','vistaPreviaPDF','generarPdf','correo','actualizarSpan','agregarRecursoAdicional','insumos','repuesto','ActualizarCheck','ActualizarListaActividades'),
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
	 public function actionActualizarSpan(){
		$mi=Yii::app()->db->createCommand("select count(*) as total from sgu_actividades where idestatus=1")->queryRow();
		
		echo CJSON::encode(array(
			'total'=>$mi["total"],
			'color'=>$this->getColor($mi["total"]),
		));
	 }
	 public function actionGenerarPdf($id){
	 
  //Consulta para buscar todos los registros
		 $mPDF1 = Yii::app()->ePdf->mpdf('utf-8','A4','','',15,15,35,25,9,9,'P'); //Esto lo pueden configurar como quieren, para eso deben de entrar en la web de MPDF para ver todo lo que permite.
		 $mPDF1->useOnlyCoreFonts = true;
		 $mPDF1->SetTitle("JuzgadoSys - Reporte");
		 $mPDF1->SetAuthor("S.G.U.");
		 $mPDF1->SetWatermarkText("U.N.E.T.");
		 $mPDF1->showWatermarkText = true;
		 $mPDF1->watermark_font = 'DejaVuSansCondensed';
		 $mPDF1->watermarkTextAlpha = 0.1;
		 $mPDF1->SetDisplayMode('fullpage');
		 $mPDF1->WriteHTML("Pruebaaa");
		 $mPDF1->Output('Orden'.date('YmdHis'),'I');
		 exit;
	}
	
	public function actionCorreo($id){
		//se envia desde la vista mail
			$model = new Mail;
		if(isset($_POST['Mail'])){
				$model->attributes=$_POST['Mail'];
				if($model->validate()){	
					$correo = PublicoController::enviarMail($model->to,$model->from,$model->subject,$model->body);
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
			
		$idvehiculo=Yii::app()->db->createCommand("select distinct( a.idvehiculo), count(*) as totAct from sgu_actividades a, sgu_detalleOrden d where d.idactividades=a.id and d.idordenMtto=".$id." group by a.idvehiculo")->queryAll();
		$totalVeh=count($idvehiculo);
		
		//$actividades=Yii::app()->db->createCommand("select idactividades from sgu_detalleorden where idordenMtto=".$id."")->queryAll();
		
		for($i=0;$i<$totalVeh;$i++){
			$vehiculos[]=new CActiveDataProvider('Vehiculo',array('criteria' => array(
			'condition' =>'id="'.$idvehiculo[$i]["idvehiculo"].'"',
			)));
			
		$totAct=Yii::app()->db->createCommand('select idactividades as id from sgu_detalleOrden where idordenMtto="'.$id.'" and idactividades in(select a.id from sgu_actividades a where a.idvehiculo="'.$idvehiculo[$i]["idvehiculo"].'")')->queryAll();
		for($j=0;$j<$idvehiculo[$i]["totAct"];$j++){		
				$actividades[$i][$j]=new CActiveDataProvider('Actividades',array('criteria' => array(
				'condition' =>'id="'.$totAct[$j]["id"].'"',
				)));
				$recursos[$i][$j]=new CActiveDataProvider('ActividadRecurso',array('criteria' => array(
				'condition' =>'idactividades="'.$totAct[$j]["id"].'"',
				)));
			}
		}
		
		$a=$this->renderPartial('vistaPreviaPDF',array(
			'vehiculos'=>$vehiculos,
			'totalVeh'=>$totalVeh,
			'actividades'=>$actividades,
			'idvehiculo'=>$idvehiculo,
			'recursos'=>$recursos,
			'orden'=>$orden,
		),true);
		
		 $mPDF1 = Yii::app()->ePdf->mpdf(); //Esto lo pueden configurar como quieren, para eso deben de entrar en la web de MPDF para ver todo lo que permite.
		 //$mPDF1->useOnlyCoreFonts = true;
		 $mPDF1->SetTitle("Solicitud de servicio SIRCA");
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
		$orden=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'id='.$id."")
			,'pagination'=>array('pageSize'=>9999999)));
			
		$idvehiculo=Yii::app()->db->createCommand("select distinct( a.idvehiculo), count(*) as totAct from sgu_actividades a, sgu_detalleOrden d where d.idactividades=a.id and d.idordenMtto=".$id." group by a.idvehiculo")->queryAll();
		$totalVeh=count($idvehiculo);
		
		//$actividades=Yii::app()->db->createCommand("select idactividades from sgu_detalleorden where idordenMtto=".$id."")->queryAll();
		
		for($i=0;$i<$totalVeh;$i++){
			$vehiculos[]=new CActiveDataProvider('Vehiculo',array('criteria' => array(
			'condition' =>'id="'.$idvehiculo[$i]["idvehiculo"].'"',
			)));
			
		$totAct=Yii::app()->db->createCommand('select idactividades as id from sgu_detalleOrden where idordenMtto="'.$id.'" and idactividades in(select a.id from sgu_actividades a where a.idvehiculo="'.$idvehiculo[$i]["idvehiculo"].'")')->queryAll();
		
		for($j=0;$j<$idvehiculo[$i]["totAct"];$j++){		
				$actividades[$i][$j]=new CActiveDataProvider('Actividades',array('criteria' => array(
				'condition' =>'id="'.$totAct[$j]["id"].'"',
				)));
				$recursos[$i][$j]=new CActiveDataProvider('ActividadRecurso',array('criteria' => array(
				'condition' =>'idactividades="'.$totAct[$j]["id"].'"',
				)));
			}
		}
		$totFactura=Yii::app()->db->createCommand('select (round(sum(ar.costoTotal),2)) as Total from sgu_actividadrecurso ar, sgu_detalleorden d where d.idactividades=ar.idactividades and d.idordenMtto="'.$id.'"')->queryRow();
		

		$factura=new CActiveDataProvider('Factura',array('criteria' => array(
			'condition'=>'idordenMtto="'.$id.'"'),
			'pagination'=>array('pageSize'=>9999999)));
			
		$this->render('vistaPrevia',array(
			'vehiculos'=>$vehiculos,
			'totalVeh'=>$totalVeh,
			'actividades'=>$actividades,
			'idvehiculo'=>$idvehiculo,
			'recursos'=>$recursos,
			'orden'=>$orden,
			'factura'=>$factura,
			'totFactura'=>$totFactura,
			'nom'=>$nom,
			'dir'=>$dir,
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
		$abiertas=Yii::app()->db->createCommand("select count(*) as total from sgu_ordenMtto where idestatus=5 and tipo=0")->queryRow();
		return $abiertas["total"];
	}
	public function getOrdenesListas(){
		$abiertas=Yii::app()->db->createCommand("select count(*) as total from sgu_ordenMtto where idestatus=6 and tipo=0")->queryRow();
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
			'condition' =>'id in (select id from sgu_ordenMtto where idestatus=6)',
			'order'=>'fecha'
			)));
		$this->render('cerrarOrdenes',array(
			'dataProvider'=>$dataProvider,
			'abiertas'=>$this->getOrdenesAbiertas(),
			'color'=>$this->getColor($this->getOrdenesAbiertas()),
			));
	}
	public function actionVerOrdenes(){
		$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'id in (select id from sgu_ordenMtto where (idestatus=5 or idestatus=6) and tipo=0)',
			'order'=>'idestatus '
			)));
		$this->render('verOrdenes',array(
			'dataProvider'=>$dataProvider,
			'abiertas'=>$this->getOrdenesAbiertas(),
			'color'=>$this->getColor($this->getOrdenesAbiertas()),
			));
	}
	public function actionAgregarFactura($id){
		$model=new Factura;
		if(isset($_POST['Factura'])){
            $model->attributes=$_POST['Factura'];
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
                'div'=>$this->renderPartial('_formFactura', array('model'=>$model,'id'=>$id), true)
				));
            exit;               
        }
	}
	public function actionRegistrarFacturacion($id,$nom,$dir){
		$model = new Factura;
		$idrecurso=0;
		$recurso=new CActiveDataProvider('Actividadrecurso',array('criteria'=>array('condition'=>'idactividades="'.$idrecurso.'"')));
		if(isset($_GET['idAct'])){	
			$idrecurso=$_GET['idAct'];
			$recurso=new CActiveDataProvider('Actividadrecurso',array('criteria'=>array('condition'=>'idactividades="'.$idrecurso.'"')));	
		}
		$dataProvider=new CActiveDataProvider('Actividades',array('criteria' => array(
			'order'=>'proximoFecha asc',
			'condition'=>'id in (select idactividades from sgu_detalleOrden where idordenMtto="'.$id.'")')
			,'pagination'=>array('pageSize'=>9999999)));
			
		$factura=new CActiveDataProvider('Factura',array('criteria' => array(
			'condition'=>'idordenMtto="'.$id.'"'),
			'pagination'=>array('pageSize'=>9999999)));
		$tot=Yii::app()->db->createCommand('select * from sgu_factura where idordenMtto="'.$id.'"')->queryAll();
		$total=count($tot);
		$this->render('registrarFacturacion',array(
			'dataProvider'=>$dataProvider,
			'modelofactura'=>$model,
			'factura'=>$factura,
			'id'=>$id,
			'recurso'=>$recurso,
			'total'=>$total,
			'nom'=>$nom,
			'dir'=>$dir,
		));
	}
	public function actionCrearOrden(){
		$model=new Ordenmtto;
		if(isset($_POST['Ordenmtto'])){
            $model->attributes=$_POST['Ordenmtto'];
            if($model->save()){
			if(isset($_POST['idAct'])){
				$act = explode(",", $_POST['idAct']);
				foreach($act as $idact){
					Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_detalleOrden` (`idactividades`,`idordenMtto`) VALUES (".$idact.",".$model->id.")")->query();
					Yii::app()->db->createCommand("update `tsg`.`sgu_actividades` set `idestatus` = '4' where `sgu_actividades`.`id` = ".$idact."")->query();
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
	public function actionCrearOrdenPreventiva(){
		//calculando el atraso e insertandolo en actividad
		$actividades=Yii::app()->db->createCommand('select * from sgu_actividades where idestatus=2')->queryAll();
		$tot=count($actividades);
		for($i=0;$i<$tot;$i++){
			if($this->getActividadAtraso($actividades[$i]["id"])<>$actividades[$i]["atraso"]){
				Yii::app()->db->createCommand("update `tsg`.`sgu_actividades` set `atraso` = ".$this->getActividadAtraso($actividades[$i]["id"])." where `sgu_actividades`.`id` = ".$actividades[$i]["id"]."")->query();	
			}
		}
		
		$modeloOrdenMtto=new Ordenmtto;
		$dataProvider=new CActiveDataProvider('Actividades',array('criteria' => array(
			//'condition' =>'idestatus=2 and atraso >=-5',
			'condition' =>'idestatus=2',
			'order'=>'proximoFecha'
			)));
		$this->render('crearOrdenPreventiva',array(
			'dataProvider'=>$dataProvider,
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
		if($id==7)	
			Yii::app()->db->createCommand("update `tsg`.`sgu_ordenMtto` set `idestatus` = '7' where `sgu_ordenMtto`.`id` = ".$_POST['id']."")->query();
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
	public function actionMttopRealizados($id,$nom,$dir){
		$orden=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'id='.$id."")
			,'pagination'=>array('pageSize'=>9999999)));
		$dataProvider=new CActiveDataProvider('Actividades',array('criteria' => array(
			'order'=>'proximoFecha asc',
			'condition'=>'id in (select idactividades from sgu_detalleOrden where idordenMtto="'.$id.'")')
			,'pagination'=>array('pageSize'=>9999999)));
		$this->render('mttopRealizados',array(
			'dataProvider'=>$dataProvider,
			'orden'=>$orden,
			'id'=>$id,
			'nom'=>$nom,
			'dir'=>$dir,
		));
	}
	public function actionActualizarCheck($id){
		$dataProvider=new CActiveDataProvider('Actividades',array('criteria' => array(
			'order'=>'proximoFecha asc',
			'condition'=>'id in (select idactividades from sgu_detalleOrden where idordenMtto="'.$id.'")')
			,'pagination'=>array('pageSize'=>9999999)));
			
		$data=$dataProvider->getData();
		for($i=0;$i<count($data);$i++){
			//if($data[$i]["fechaRealizada"]=="0000-01-01" or $data[$i]["kmRealizada"]==-1){
			if($data[$i]["idestatus"]<>3){
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
                $model=new Actividadrecurso;
				$tipoInsumo=new Tipoinsumo();
				$tipoRepuesto=new Subtiporepuesto();
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
 
    if(isset($_POST['Actividadrecurso'])){
            $model->attributes=$_POST['Actividadrecurso'];
            if($model->save()){
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
	
	public function actionPlanes(){
		$idGrupo=0;
		$idAct=0;
		$grupo=Grupo::model()->findAll();
		
		if(isset($_GET['idGrupo'])||isset($_GET['idAct'])){
			if(isset($_GET['idGrupo'])){
				
				$idGrupo=$_GET['idGrupo'];
			}
			if(isset($_GET['idAct'])){
				$idAct=$_GET['idAct'];
			}
		}
			$actividades=new CActiveDataProvider('Actividadesgrupo',array('criteria'=>array('condition'=>'idgrupo="'.$idGrupo.'"')));
			$actividades->setPagination(false);
			$recurso=new CActiveDataProvider('Actividadrecursogrupo',array('criteria'=>array('condition'=>'idactividadesGrupo="'.$idAct.'"')));
			$recurso->setPagination(false);
		$mi=Yii::app()->db->createCommand("select count(*) as total from sgu_actividades where idestatus=1")->queryRow();
		$this->render('planes',array(
			'grupo'=>$grupo,
			'actividades'=>$actividades,
			'recurso'=>$recurso,
			'color'=>$this->getColor($mi["total"]),
			'mi'=>$mi["total"],
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
		$dataProvider=new CActiveDataProvider('Actividadrecurso',array('criteria'=>array('condition'=>'costoTotal>0')));
		$this->render('historicoGastos',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function actionHistoricoPreventivo(){
	//idplan in (select id from sgu_plan) and ??
			$dataProvider=new CActiveDataProvider('Actividades',array('criteria' => array(
				'condition' =>'idestatus=3',
				'order'=>'ultimoFecha'
			)));
			$mi=Yii::app()->db->createCommand("select count(*) as total from sgu_actividades where idestatus=1")->queryRow();
		$this->render('historicoPreventivo',array(
				'dataProvider'=>$dataProvider,
				'mi'=>$mi['total'],
				'color'=>$this->getColor($mi["total"]),
				'abiertas'=>$this->getOrdenesAbiertas(),
				'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
				'Colorli'=>$this->getColor($this->getOrdenesListas()),
				'listas'=>$this->getOrdenesListas(),
			));
	}
	public function actionHistoricoOrdenes(){
	$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'id in (select id from sgu_ordenMtto where idestatus=7)',
			'order'=>'fecha'
			)));
		$this->render('historicoOrdenes',array(
			'dataProvider'=>$dataProvider,
			'abiertas'=>$this->getOrdenesAbiertas(),
			'color'=>$this->getColor($this->getOrdenesAbiertas()),
			));
	}
	public function actionIndex(){
		$ca=1;
		if(isset($_GET["filtro"]))
					$ca=$_GET["filtro"];
			
		$cond='idestatus<>1 and idestatus<>3 and idestatus<>4 and (month(proximoFecha)=month(now()) and (year(proximoFecha)=year(now())))';
			if(isset($_GET["filtro"])){
				if($_GET["filtro"]==1)
					$cond='idestatus<>1 and idestatus<>3 and idestatus<>4 and (month(proximoFecha)=month(now()) and (year(proximoFecha)=year(now())))';
				if($_GET["filtro"]==2)
					$cond='idestatus=4';
				if($_GET["filtro"]==3)
					$cond='idestatus<>1 and idestatus<>3';
				if($_GET["filtro"]==4)
					$cond='idestatus<>1 and idestatus<>3 and idestatus<>4 and (proximoFecha<=now() or t.proximoKm-(select lectura from sgu_kilometraje where idvehiculo=t.idvehiculo order by id desc limit 1)<=0 )';
			}
			
			$dataProvider=new CActiveDataProvider('Actividades',array('criteria' => array(
			'condition' =>$cond,
			'order'=>'proximoFecha'
			)));
			$mi=Yii::app()->db->createCommand("select count(*) as total from sgu_actividades where idestatus=1")->queryRow();
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'mi'=>$mi['total'],
			'color'=>$this->getColor($mi["total"]),
			'abiertas'=>$this->getOrdenesAbiertas(),
			'Colorabi'=>$this->getColor($this->getOrdenesAbiertas()),
			'Colorli'=>$this->getColor($this->getOrdenesListas()),
			'listas'=>$this->getOrdenesListas(),
			'ca'=>$ca,
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
	public function actionInsumos($id){
			$lista2=Insumo::model()->findAll('tipoInsumo = :id',array(':id'=>$id));
			foreach($lista2 as $li){
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li->id))),Chtml::encode(($li->insumo)),true);
			}
	}
	public function actionRepuesto($id){
			$lista2=Repuesto::model()->findAll('idsubTipoRepuesto = :id',array(':id'=>$id));
			foreach($lista2 as $li){
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li->id))),Chtml::encode(($li->repuesto)),true);
			}
	}
	public function actionActualizarListaActividades(){
	
			$lista2=Actividadmtto::model()->findAll('1 order by id DESC',array(':id'=>'1'));
			foreach($lista2 as $li){
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li->id))),Chtml::encode(($li->actividad)),true);
			
		}
	}
}
