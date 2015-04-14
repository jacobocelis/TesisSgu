<?php

/**
 * Description of vehiculoTest
 * Comprueba la correcta inserción de un registro de prueba en la base de datos
 * 
 */
class GrupoTest extends CTestCase{
    
    private $grupo_id;
    private $valores = array(
            'grupo'=>"Chevrolet corsa S/AC",
            'descripcion'=>"",
            'idtipo'=>1,
        );

    public function testRegistroRepuesto(){
        $grupo= new Grupo;
        $grupo->setAttributes($this->valores);
        //se registra el grupo
        $this->assertTrue($grupo->save());
        $this->grupo_id=$grupo->id;
        //se verifica que los datos guardados del grupo fueron los ingresados
        $this->assertEquals("Chevrolet corsa S/AC",$grupo->grupo);
        $this->assertEquals("",$grupo->descripcion);
        $this->assertEquals(1,$grupo->idtipo);
         
    }
    function tearDown(){
        if($this->grupo_id){
           Grupo::model()->findByPk($this->grupo_id)->delete();
        }
    }
}
    