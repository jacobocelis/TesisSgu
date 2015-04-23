<?php

class RepuestoTest extends CTestCase{
    public  $modelo;
     function setUp(){
        parent::setUp();
        $_POST['CaracteristicaVehGrupo']['cantidad'] = 1;
        $_POST['CaracteristicaVehGrupo']['idgrupo'] = 1;
        $_POST['CaracteristicaVehGrupo']['idrepuesto'] = 1;
    }
    public function testAsignarRepuestoGrupo(){
        $repuesto = new RepuestoController("repuesto");
        $this->assertTrue($repuesto->AsignarRepuestoGrupo());
        //verificamos que el registro se guardó en la bd y los datos coincidan
        $this->modelo = Caracteristicavehgrupo::model()->find();
        $this->assertEquals(1,$this->modelo->cantidad);
        $this->assertEquals(1,$this->modelo->idgrupo);
        $this->assertEquals(1,$this->modelo->idrepuesto);
    }
    
    
    
    
    /*function setUp(){
        parent::setUp();
        $_POST['Repuesto']['repuesto'] = "Batería";
        $_POST['Repuesto']['descripcion'] = 'Celdas recargables';
        $_POST['Repuesto']['idsubTipoRepuesto'] = 1;
        $_POST['Repuesto']['idunidad'] = 1;
    }
    public function testRegistroRepuesto(){
        $repuesto = new RepuestoController("repuesto");
        $this->assertTrue($repuesto->RegistrarRepuesto());
        //verificamos que el registro se guardó en la bd y los datos coincidan
        $this->modelo = Repuesto::model()->find();
        $this->assertEquals('Batería',$this->modelo->repuesto);
        $this->assertEquals('Celdas recargables',$this->modelo->descripcion);
        $this->assertEquals(1,$this->modelo->idsubTipoRepuesto);
        $this->assertEquals(1,$this->modelo->idunidad);
 
    }*/
    
    
    /*function tearDown(){
        if($this->modelo->id){
           Repuesto::model()->findByPk($this->modelo->id)->delete();
        }
    }*/
}
    