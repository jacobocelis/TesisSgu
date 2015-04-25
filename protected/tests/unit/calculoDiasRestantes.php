<?php

class calculoDiasRestantes extends CTestCase {
    public $fechaMantenimiento="2015-06-02";
    public $diasRestantes=40;
    
    function testDiasRestantes(){
       $modelo = new Actividades;
       $this->assertEquals($modelo->diasRestantes($this->fechaMantenimiento),$this->diasRestantes);
    }
}
