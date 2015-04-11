<?php


class calculoAtraso extends CTestCase {
    public $fechaMtto="2015-04-01";
    public $AtrasoEsperado="10 Días";
    
    function testAtraso(){
       $modelo = new Actividades;
       $this->assertEquals($modelo->atraso($this->fechaMtto),$this->AtrasoEsperado);
    }
    
}
