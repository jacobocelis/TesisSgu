<?php
class GrupoTest extends CTestCase {
    public $modelo;
    function setUp(){
        parent::setUp();
        $_POST["Grupo"]["grupo"] = 'Encava-ENT100';
        $_POST["Grupo"]["descripcion"] = 'Autobuses grandes';
        $_POST["Grupo"]["idtipo"] = 1;
    }
    public function testRegistrarGrupo(){
        $grupo = new GrupoController('grupo');
        $this->assertTrue($grupo->RegistrarGrupo());
        $this->modelo = Grupo::model()->find();
        $this->assertEquals('Encava-ENT100',$this->modelo->grupo);
        $this->assertEquals('Autobuses grandes',$this->modelo->descripcion);
        $this->assertEquals(1,$this->modelo->idtipo);
    }

    /*function tearDown(){
        if($this->modelo->id){
           Grupo::model()->findByPk($this->modelo->id)->delete();
        }
    }*/
}
