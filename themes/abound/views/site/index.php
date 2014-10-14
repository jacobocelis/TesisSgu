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

function setNotificaciones($notif) {
    $arrayInt = array();
    foreach ($notif as $t) {
        $titulo = $t['estatus'] . ' - ' . $t['Titulo'];
        if (array_key_exists('Descripcion', $t)) {
            $contenido = '<p>' . $t['Descripcion'] . '</p>';
        } else {
            $contenido = '<p>' . $t['Temática y Linea de investigacion'] . '</p>';
        }
        $arrayInt[$titulo] = $contenido;
    }
    return $arrayInt;
    $varCaracteristica = array();
}

if (isset($_GET["tipo"]))
    switch ($_GET["tipo"]) {
        case 1:
            $arrayNot = setNotificaciones($varTesis);

            break;
        case 2:
            $arrayNot = setNotificaciones($varPasantias);

            break;

        case 3:
            $arrayNot = setNotificaciones($varCaracteristica);

            break;

        default:
            break;
    } else {
    $arrayNot = setNotificaciones($varTesis);
}
?>

<div class="controls-row">
    <div class="span3">
        
    </div>
    <div class="span8">  
        <div class="portlet" id="accordion">
            <div class="portlet-decoration">
                <div class="portlet-title">Inicio</div>
            </div>
            <div class="portlet-content">     
                <?php
                echo CHtml::link('Vehiculos',array('vehiculo/index')); ?><br>
				<?php echo CHtml::link('Piezas y repuestos',array('repuesto/index')); ?><br>
                <?php echo CHtml::link('Mantenimiento preventivo',array('vehiculo/index')); ?><br>
				<?php echo CHtml::link('Mantenimiento correctivo',array('vehiculo/index')); ?><br>
				<?php echo CHtml::link('Reportes y estadísticas',array('vehiculo/index')); ?><br>
            </div>
        </div>
    </div>
</div>
