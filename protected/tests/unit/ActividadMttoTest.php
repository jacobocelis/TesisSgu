<?php
class ActividadMttoTest extends CTestCase{
    
    private $modelo;
    
    function setUp(){
        parent::setUp();
        $_POST['Actividadmtto']['actividad'] = 'Cambio de batería';
    }
    
    public function testRegistroActividadMtto(){
        $actividad = new ActividadmttoController("actividadMtto");
        $this->assertTrue($actividad->RegistrarActividad());
        /*verificamos que el registro se guardó en la bd y los datos coincidan*/
        $this->modelo = Actividadmtto::model()->find();
        $this->assertEquals('Cambio de batería',$this->modelo->actividad);
    }
    
    
    
    
    
    
    
    /*function tearDown(){
        if($this->actividad_id){
           Actividadesgrupo::model()->findByPk($this->actividad_id)->delete();
        }
    }*/
}
    