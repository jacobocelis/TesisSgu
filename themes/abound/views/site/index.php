<?php

$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;

if (Yii::app()->user->isGuest)
    $this->redirect('cruge/ui/login');

$id = Yii::app()->user->id;
$rol = Yii::app()->getSession()->get('rolActual');

if ($rol == "Jefe Departamento") {

    $varTesis = getTesis('Pertinente');

    $varPasantias = getPasantias('Pertinente');

    $varCaracteristica = array();
} else if ($rol == "Tutor") {

    $varTesis = getTesisTJ('Demandado', $id, $rol) +
            getTesisTJ('Inscrito', $id, $rol) +
            getTesisTJ('Solicitar abandono', $id, $rol) +
            getTesisTJ('Vencido', $id, $rol) +
            getTesisTJ('Reprobado', $id, $rol) +
            getTesisTJ('Aprobado', $id, $rol);

    $varPasantias = getPasantiaTJ('Demandado', $id, $rol) +
            getPasantiaTJ('Inscrito', $id, $rol) +
            getPasantiaTJ('Solicitar abandono', $id, $rol) +
            getPasantiaTJ('Vencido', $id, $rol) +
            getPasantiaTJ('Reprobado', $id, $rol) +
            getPasantiaTJ('Aprobado', $id, $rol);

    $varCaracteristica = getCaracteristicasEvaluador($rol, $id);
} else if ($rol == "Jurado") {

    $varTesis = getTesisTJ('Inscrito', $id, $rol) +
            getTesisTJ('Completado', $id, $rol) +
            getTesisTJ('Vencido', $id, $rol) +
            getTesisTJ('Por defender', $id, $rol);

    $varPasantias = getPasantiaTJ('Inscrito', $id, $rol) +
            getPasantiaTJ('Completado', $id, $rol) +
            getPasantiaTJ('Vencido', $id, $rol) +
            getPasantiaTJ('Por defender', $id, $rol);

    $varCaracteristica = getCaracteristicasEvaluador($rol, $id);
} else if ($rol == "Comision TAP") {

    $varTesis = getTesis('Ofertado') +
            getTesis('Pre-Inscrito') +
            getTesis('Abandonado') +
            getTesis('Por defender') +
            getTesis('Vencido');

    $varPasantias = getPasantias('Ofertado') +
            getPasantias('Pre-Inscrito') +
            getPasantias('Abandonado') +
            getPasantias('Por defender') +
            getPasantias('Vencido');

    $varCaracteristica = array();
} else if ($rol == "Estudiante") {

    $varTesis = getTesisEst($id);

    $varPasantias = getPasantiasEst($id);

    $varCaracteristica = getCaracteristicasEstudiante($id);
} else {
    $varTesis = array();
    $varPasantias = array();
    $varCaracteristica = array();
}


?>



    <div class="span8">  
			
				<div id="uno">
					
					<a href="<?php echo Yii::app()->request->baseUrl;?>/vehiculo/" id="vehiculos"></a>
					
					
				</div>
			
					
				
					<a href="<?php echo Yii::app()->request->baseUrl;?>/repuesto/" id="repuesto"></a>
				
			
				
				<a href="<?php echo Yii::app()->request->baseUrl;?>/mttoPreventivo/" id="preventivo">
				
				</a>
				
				<a href="<?php echo Yii::app()->request->baseUrl;?>" id="correctivo">
				
				</a>
				
				<a href="<?php echo Yii::app()->request->baseUrl;?>" id="combustible">
				
				</a>
			
				<a href="<?php echo Yii::app()->request->baseUrl;?>" id="viajes">
				
				</a>
			
            
  
	
</div>
<style>

.span8 {
    margin-left: 17%;
    width: 68%;
	margin-top: 2%;
	   border: 1px dotted #aaa;
    border-radius: 5px;
   padding: 5px;
   overflow: auto;
}
#vehiculos{
margin-top: 4%;
 margin-right: 2%;
background-image: url("<?php echo Yii::app()->request->baseUrl;?>/imagenes/vehiculos.png");
height: 145px;
width: 150px;
display: block;
  //margin: 0 auto;
  text-indent: -9999px;
  float:left;
}
#repuesto{
margin-top: 4%;
 margin-right: 2%;
background-image: url("<?php echo Yii::app()->request->baseUrl;?>/imagenes/piezas.png");
height: 145px;
width: 125px;
display: block;
  //margin: 0 auto;
  text-indent: -9999px;
  float:left;
}
#preventivo{
margin-top: 4%;
 margin-right: 2%;
background-image: url("<?php echo Yii::app()->request->baseUrl;?>/imagenes/preventivo.png");
height: 145px;
width: 125px;
display: block;
  //margin: 0 auto;
  text-indent: -9999px;
  float:left;
}
#correctivo{
margin-top: 4%;
 margin-right: 2%;
background-image: url("<?php echo Yii::app()->request->baseUrl;?>/imagenes/correctivo.png");
height: 148px;
width: 125px;
display: block;
  //margin: 0 auto;
  text-indent: -9999px;
  float:left;
}
#combustible{
margin-top: 4%;
 margin-right: 2%;
background-image: url("<?php echo Yii::app()->request->baseUrl;?>/imagenes/combustible.png");
height: 145px;
width: 125px;
display: block;
  //margin: 0 auto;
  text-indent: -9999px;
  float:left;
}
#viajes{
margin-top: 4%;
 margin-right: 2%;
background-image: url("<?php echo Yii::app()->request->baseUrl;?>/imagenes/viajes.png");
height: 145px;
width: 125px;
display: block;
  //margin: 0 auto;
  text-indent: -9999px;
  float:left;
}


</style>