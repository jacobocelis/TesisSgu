<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuariosTest
 *
 * @author Jacobo
 */
class UsuariosTest extends CDbTestCase {
    private $usuario_id;
 
    public function obtenerUsuario($id){
        $usuario = Yii::app()->user->um->loadUserById($id,true);
        return $usuario->username;
    }
    function testUsuarios(){
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
