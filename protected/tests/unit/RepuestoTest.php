<?php

/**
 * Description of vehiculoTest
 * Comprueba la correcta inserción de un registro de prueba en la base de datos
 * 
 */
class RepuestoTest extends CTestCase{
    
    private $repuesto_id;
    private $valores = array(
            'repuesto'=>"Distribuidor",
            'descripcion'=>"",
            'idsubTipoRepuesto'=>1,
            'idunidad'=>1,
        );

    public function testRegistroRepuesto(){
        $repuesto= new Repuesto;
        $repuesto->setAttributes($this->valores,false);
        //se registra el repuesto
        $this->assertTrue($repuesto->save());
        $this->repuesto_id=$repuesto->id;
        //se verifica que los datos guardados del repuesto fueron los ingresados
        $this->assertEquals("Distribuidor",$repuesto->repuesto);
        $this->assertEquals(1,$repuesto->idsubTipoRepuesto);
        $this->assertEquals(1,$repuesto->idunidad);
         
    }
    function tearDown(){
        if($this->repuesto_id){
           Repuesto::model()->findByPk($this->repuesto_id)->delete();
        }
    }
}
    