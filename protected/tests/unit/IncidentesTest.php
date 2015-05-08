<?php
class IncidentesTest extends CTestCase{
    public  $modelo;
     function setUp(){
        parent::setUp();
        $_POST['Reportefalla']['fechaFalla'] = '10/04/2015';
        $_POST['Reportefalla']['detalle'] = 'EL vehiculo se recalentó';
        $_POST['Reportefalla']['lugar'] = 'Las lomas';
        $_POST['Reportefalla']['idempleado'] = 1;
        $_POST['Reportefalla']['idvehiculo'] = 1;
        $_POST['Reportefalla']['fechaRealizada'] = '12/04/2015';
        $_POST['Reportefalla']['arreglos'] = 'Reparación de radiador por fuga de refrigerante';
        $_POST['Reportefalla']['diasParo'] = 2;
    }
    public function testRegistroIncidente(){
        $incidente = new MttoCorrectivoController("mttocorrectivo");
        $this->assertTrue($incidente->RegistroIncidente());
        //verificamos que el registro se guardó en la bd y los datos coincidan
        $this->modelo = Reportefalla::model()->find();
        $this->assertEquals('10/04/2015',$this->modelo->fechaFalla);
        $this->assertEquals('EL vehiculo se recalentó',$this->modelo->detalle);
        $this->assertEquals('Las lomas',$this->modelo->lugar);
        $this->assertEquals(1,$this->modelo->idempleado);
        $this->assertEquals(1,$this->modelo->idvehiculo);
        $this->assertEquals('12/04/2015',$this->modelo->fechaRealizada);
        $this->assertEquals('Reparación de radiador por fuga de refrigerante',$this->modelo->arreglos);
        $this->assertEquals(2,$this->modelo->diasParo);
    }  
}