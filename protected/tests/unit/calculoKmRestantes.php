<?php


class calculoKmRestantes extends CTestCase {
    public $lecturaActual=100000;
    public $kmProximoMtto=125000;
    public $valorEsperado=25000;
    
    function testKmRestantes(){
       $modelo = new Actividades;
       $this->assertEquals($modelo->kmsRestantes($this->lecturaActual,$this->kmProximoMtto),$this->valorEsperado);
    }
    
}
