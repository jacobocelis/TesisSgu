<?php class VehiculoTest extends CDbTestCase
{
    private function getVehiculo($unidad){
        $vehiculo =Vehiculo::model()->findByAttributes(array("numeroUnidad"=>$unidad));
        return $vehiculo->anno;
    }
    function testMarca(){
        $this->assertEquals(2006,$this->getVehiculo(1));
    }
}
?>