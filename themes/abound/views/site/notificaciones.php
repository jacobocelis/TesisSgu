<?php


function getPorEstado($estado) {
    $consulta = Yii::app()->db->createCommand("CALL estatusTesis('" . $estado . "')");
    $resul = $consulta->queryAll();
    return $resul;
}

function getTesis($estado) {
    $consulta = Yii::app()->db->createCommand("CALL estatusTesis('" . $estado . "')");
    $resul = $consulta->queryAll();
    return $resul;
}

function getPasantias($estado) {
    $consulta = Yii::app()->db->createCommand("CALL estatusPasantia('" . $estado . "')");
    $resul = $consulta->queryAll();
    return $resul;
}

function getTesisTJ($estado, $idUsuario, $rol) {//Evaluador
    $consulta = Yii::app()->db->createCommand("CALL Tesis_TJ('" . $estado . "','" . $idUsuario . "','" . $rol . "')");
    $resul = $consulta->queryAll();
    return $resul;
}

function getPasantiaTJ($estado, $idUsuario, $rol) {//Evaluador
    $consulta = Yii::app()->db->createCommand("CALL Pasantia_TJ('" . $estado . "','" . $idUsuario . "','" . $rol . "')");
    $resul = $consulta->queryAll();
    return $resul;
}

function getTesisEst($id) {
    $consulta = Yii::app()->db->createCommand("CALL Tesis_Est('" . $id . "')");
    $resul = $consulta->queryAll();
    return $resul;
}

function getPasantiasEst($id) {
    $consulta = Yii::app()->db->createCommand("CALL Pasantia_Est('" . $id . "')");
    $resul = $consulta->queryAll();
    return $resul;
}

function getCaracteristicasEvaluador($rol, $usuario) {
    $consulta = Yii::app()->db->createCommand("CALL Caracteristica_Evaluador('" . $rol . "','" . $usuario . "')");
    $resul = $consulta->queryAll();
    return $resul;
}

function getCaracteristicasEstudiante($usuario) {
    $consulta = Yii::app()->db->createCommand("CALL Caracteristica_Estudiante('" . $usuario . "')");
    $resul = $consulta->queryAll();
    return $resul;
}

?>
