<?php

/**
 * Description of vehiculoTest
 * Comprueba la correcta inserción de un registro de prueba en la base de datos
 * 
 */
class VehiculoTest extends CTestCase{
    public $modelo;
 
    public function fecha(){
        $vehiculo = new IndicadoresController("vehiculo");
        $vehiculo->mtto();
    }
}
    