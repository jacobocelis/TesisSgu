<?php

/**
 * Description of vehiculoTest
 * Comprueba la correcta inserción de un registro de prueba en la base de datos
 * 
 */
class VehiculoTest extends CTestCase{
    
    private $vehiculo_id;
    private $valores = array(
            'numeroUnidad'=>5,
            'serialCarroceria'=>'12345ABCDE',
            'serialMotor'=>'ABCD1234',
            'placa'=>'ABC12DE',
            'anno'=>2008,
            'nroPuestos'=>5,
            'idmodelo'=>1,
            'idgrupo'=>1,
            'idcombustible'=>1,
            'idcolor'=>1,
            'idpropiedad'=>1,
            'KmInicial'=>20000,
        );
    
    public function testRegistroVehiculo(){
        $vehiculo= new Vehiculo;
        $vehiculo->setAttributes($this->valores);
        //se registra el vehiculo
        $this->assertTrue($vehiculo->save());
        $this->vehiculo_id=$vehiculo->id;
        //se verifica que los datos guardados del vehiculo fueron los ingresados
        $this->assertEquals(6,$vehiculo->numeroUnidad);
        $this->assertEquals('12345ABCDE',$vehiculo->serialCarroceria);
        $this->assertEquals('ABCD1234',$vehiculo->serialMotor);
        $this->assertEquals('ABC12DE',$vehiculo->placa);
        $this->assertEquals(2008,$vehiculo->anno);
        $this->assertEquals(5,$vehiculo->nroPuestos);
        $this->assertEquals(1,$vehiculo->idmodelo);
        $this->assertEquals(1,$vehiculo->idgrupo);
        $this->assertEquals(1,$vehiculo->idcombustible);
        $this->assertEquals(1,$vehiculo->idcolor);
        $this->assertEquals(1,$vehiculo->idpropiedad);
        $this->assertEquals(20000,$vehiculo->KmInicial);
    }
    function tearDown(){
        if($this->vehiculo_id){
           Vehiculo::model()->findByPk($this->vehiculo_id)->delete();
        }
    }
}
    