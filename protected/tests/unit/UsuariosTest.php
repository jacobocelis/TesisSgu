<?php
/**
 * Description of UsuariosTest
 *
 * 
 */
class UsuariosTest extends CDbTestCase {
    private $usuario_id;
 
    public function obtenerUsuario($id){
        $usuario = Yii::app()->user->um->loadUserById($id,true);
        return $usuario->username;
    }
    function testListarUsuarios(){
        $this->assertEquals("admin",  $this->obtenerUsuario(1));
    }
    function testRegistrarUsuario(){
        $usuario = Yii::app()->user->um->createBlankUser();
        $usuario->username="Operador";
        $usuario->email="operador@unet.edu.ve";
        $usuario->password="123456";
        
        $this->assertTrue(Yii::app()->user->um->save($usuario));
        $this->usuario_id=$usuario->iduser;
        
        /*verificamos los datos del usuario agregado*/
        $this->assertEquals("Operador",$usuario->username);
        $this->assertEquals("123456",$usuario->password);
        $this->assertEquals("operador@unet.edu.ve",$usuario->email);
    }
    function tearDown(){
        if($this->usuario_id){
           Yii::app()->user->um->loadUserById($this->usuario_id,true)->delete();
        }
    }
}
