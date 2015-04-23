<?php

/**
 * Description of vehiculoTest
 * Comprueba la correcta inserción de un registro de prueba en la base de datos
 * 
 */
class VehiculoTest extends CTestCase{
    public $modelo;
 
    function setUp(){
        parent::setUp();
        $_POST['Vehiculo']['numeroUnidad'] = 1;
        $_POST['Vehiculo']['serialCarroceria'] = '12345ABCDE';
        $_POST['Vehiculo']['serialMotor'] = 'ABCD1234';
        $_POST['Vehiculo']['placa'] = 'ABC12DE';
        $_POST['Vehiculo']['anno'] = 2015;
        $_POST['Vehiculo']['nroPuestos'] = 5;
        $_POST['Vehiculo']['idmodelo'] = 1;
        $_POST['Vehiculo']['idgrupo'] = 1;
        $_POST['Vehiculo']['idcombustible'] = 1;
        $_POST['Vehiculo']['idcolor'] = 1;
        $_POST['Vehiculo']['idpropiedad'] = 1;
        $_POST['Vehiculo']['KmInicial'] = 1000;
    }
    public function testRegistroVehiculo(){
        $vehiculo = new VehiculoController("vehiculo");
        $this->assertTrue($vehiculo->RegistrarVehiculo());
        /*verificamos que el registro se guardó en la bd y los datos coincidan*/
        $this->modelo = Vehiculo::model()->find();
        $this->assertEquals(1,$this->modelo->numeroUnidad);
        $this->assertEquals('12345ABCDE',$this->modelo->serialCarroceria);
        $this->assertEquals('ABCD1234',$this->modelo->serialMotor);
        $this->assertEquals('ABC12DE',$this->modelo->placa);
        $this->assertEquals(2015,$this->modelo->anno);
        $this->assertEquals(5,$this->modelo->nroPuestos);
        $this->assertEquals(1,$this->modelo->idmodelo);
        $this->assertEquals(1,$this->modelo->idgrupo);
        $this->assertEquals(1,$this->modelo->idcombustible);
        $this->assertEquals(1,$this->modelo->idcolor);
        $this->assertEquals(1,$this->modelo->idpropiedad);
        $this->assertEquals(1000,$this->modelo->KmInicial);
        /*intentamos registrar el mismo vehiculo de nuevo, 
         * sí ya existe retorna false*/
        $this->assertFalse($vehiculo->RegistrarVehiculo());
    }
    /*function tearDown(){
        if($this->modelo->id){
           Vehiculo::model()->findByPk($this->modelo->id)->delete();
        }
    }*/
}
    