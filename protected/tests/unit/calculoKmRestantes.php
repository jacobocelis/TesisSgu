<?php


class calculoKmRestantes extends CTestCase {
    public $lecturaActual=10;
    public $kmProximoMtto=100;
    public $valorEsperado=90;
    
    function testKmRestantes(){
       $modelo = new Actividades;
       $this->assertEquals($modelo->kmsRestantes($this->lecturaActual,$this->kmProximoMtto),$this->valorEsperado);
    }
}
