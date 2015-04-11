<?php


class calculoDiasRestantes extends CTestCase {
    public $fechaMantenimiento="2015-05-31";
    public $diasRestantes=50;
    
    function testDiasRestantes(){
       $modelo = new Actividades;
       $this->assertEquals($modelo->diasRestantes($this->fechaMantenimiento),$this->diasRestantes);
    }
    
}
