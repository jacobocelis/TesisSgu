<?php

/**
 * Description of vehiculoTest
 * Comprueba la correcta inserción de un registro de prueba en la base de datos
 * 
 */
class ActividadMttoTest extends CTestCase{
    
    private $actividad_id;
    private $valores = array(
            'idactividadMtto'=>1,
            'frecuenciaKm'=>5000,
            'frecuenciaMes'=>30,
            'idprioridad'=>1,
            'idtiempod'=>1,
            'idtiempof'=>1,
            'idgrupo'=>1,
    );
    public function testRegistroActividadMtto(){
        $actividad= new Actividadesgrupo;
        $actividad->setAttributes($this->valores);
        //se registra la actividad
        $this->assertTrue($actividad->save());
        $this->actividad_id=$actividad->id;
        //se verifica que los datos guardados de la atividad fueron los ingresados
        $this->assertEquals(1,$actividad->idactividadMtto);
        $this->assertEquals(5000,$actividad->frecuenciaKm);
        $this->assertEquals(30,$actividad->frecuenciaMes);
        $this->assertEquals(1,$actividad->idprioridad);
        $this->assertEquals(1,$actividad->idtiempod);
        $this->assertEquals(1,$actividad->idtiempof);
        $this->assertEquals(1,$actividad->idgrupo);
    }
    function tearDown(){
        if($this->actividad_id){
           Actividadesgrupo::model()->findByPk($this->actividad_id)->delete();
        }
    }
}
    