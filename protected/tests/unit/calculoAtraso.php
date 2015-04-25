<?php

class calculoAtraso extends CTestCase {
    
    public $fechaMtto="2015-04-01";
    public $AtrasoEsperado="24 Días";
    //tomando como fecha actual 2015-04-23
    
    function testAtraso(){
       $modelo = new Actividades;
       $this->assertEquals($modelo->atraso($this->fechaMtto),$this->AtrasoEsperado);
    }
}
