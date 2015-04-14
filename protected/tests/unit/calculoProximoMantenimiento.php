<?php

class calculoProximoMantenimiento extends CTestCase {
    /*VALORES ESPERADOS*/
    
    public $actividad;
    public $proximoKmEsperado=30000;
    public $proximoFechaEsperado='2015-01-31';
    
    function actividadInicial(){
        $this->actividad = Actividades::model()->findByPk(1);
        /*VALORES DE PRUEBA*/
        
        $this->actividad->kmRealizada=25000;
        $this->actividad->frecuenciaKm=5000;
        $this->actividad->fechaRealizada='2015-01-01';
        $this->actividad->frecuenciaMes=30;
        $this->actividad->idtiempof=1; //1=dias,2=meses,3=años
        $this->actividad->idestatus=4; 
        return $this->actividad;
    }
    function testProximoMantenimiento(){
        $act = new ActividadesController("Actividades");
        $act->nuevaActividad($this->actividadInicial());
        $ult=Yii::app()->db->createCommand("select * from sgu_actividades where idactividadesGrupo=".$this->actividad->idactividadesGrupo." and idvehiculo= ".$this->actividad->idvehiculo." and idactividadMtto=".$this->actividad->idactividadMtto." order by id desc limit 1")->queryRow();
        /*si la actividad fue realizada a los 30,000km se espera la proxima a los 35000 con frecuencia 5,000km*/
        $this->assertEquals($this->proximoKmEsperado,$ult["proximoKm"]);
        /*si la actividad fue realizada el 01/01/2015 se espera la proxima sea el dia 31/01/2015 con frecuencia 30dias*/
        $this->assertEquals($this->proximoFechaEsperado,$ult["proximoFecha"]);
    }
}
