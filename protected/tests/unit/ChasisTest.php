<?php

/**
 * Description of vehiculoTest
 * Comprueba la correcta inserción de un registro de prueba en la base de datos
 * 
 */
class ChasisTest extends CTestCase{
    
    private $chasis_id;
    private $valores = array(
            'nombre'=>"Automovil",
            'nroEjes'=>2,
            'cantidadNormales'=>4,
            'cantidadRepuesto'=>1,
    );
    public function testRegistroChasis(){
        $chasis= new Chasis;
        $chasis->setAttributes($this->valores);
        //se registra la actividad
        $this->assertTrue($chasis->save());
        $this->chasis_id=$chasis->id;
        //se verifica que los datos guardados de la atividad fueron los ingresados
        $this->assertEquals("Automovil",$chasis->nombre);
        $this->assertEquals(2,$chasis->nroEjes);
        $this->assertEquals(4,$chasis->cantidadNormales);
        $this->assertEquals(1,$chasis->cantidadRepuesto);
    }
    function tearDown(){
        if($this->chasis_id){
           Chasis::model()->findByPk($this->chasis_id)->delete();
        }
    }
}
    