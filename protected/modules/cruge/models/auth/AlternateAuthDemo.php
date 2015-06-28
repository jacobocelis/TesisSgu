<?php
/*
	Esta es una clase de demostracion para que se conozca como crear metodos alternos de inicio de sesion.

	en esta clase se autenticara al usuario contra la lista de user y password definida en config/main asi:


	// EN CONFIG/MAIN LE INDICAS A CRUGE QUE USE ESTA CLASE 'authdemo':

		'cruge'=>array(
			'tableprefix'=>'cruge_',
			// 'availableAuthMethods'=>array('default'),
			'availableAuthMethods'=>array('authdemo'),
			...
			...
			(el string "authdemo" debe esta definido en la clase de autenticacion,
			este string es devuelto en la clase: AlternateAuthDemo.php )


 	@author: Christian Salazar H. <christiansalazarh@gmail.com> @salazarchris74
	@license protected/modules/cruge/LICENSE
*/
class AlternateAuthDemo extends CBaseUserIdentity implements ICrugeAuth
{

    private $username;
    private $password;
    private $options;

    private $_user;

    /**
    este nombre sera referenciado en config/main para hacerle saber a Cruge que use esta clase
    para autenticar:

    'availableAuthMethods'=>array('authdemo'),
     */
    public function authName()
    {
        return "authdemo";
    }

    /*	no confundir con un getUserName, esto es un getUser a nivel de instancia,
        debe retornar algun objeto que implemente a ICrugeStoredUser, por defecto se puede usar un
        objeto de clase CrugeStoredUser.

        @returns instancia de ICrugeStoredUser hallado tras la autenticacion exitosa
    */
    public function getUser()
    {
        return $this->_user;
    }

    /*
        recibe desde cruge parametros considerados como user y password, pueden no ser user y password a nivel
        conceptual..sino por ejemplo, cedula y clave, numerotarjeta y clave, etc.
    */
    public function setParameters($username, $password, $options = array())
    {
        $this->username = $username;
        $this->password = $password;
        $this->options = $options;
    }

    public function authenticate()
    {

        $tipo=4;
        $activo=0;
        $server="192.168.0.50";
        $cn="profread";
        $pwd="UnLectP013.";
        $user = $this->username;
        $pass = $this->password; 
        $dominio="dc=unet,dc=edu,dc=ve";
        $ds=ldap_connect($server);  
        //$this->setState('result','NADA');
        if($ds){

            ldap_set_option($ds,LDAP_OPT_PROTOCOL_VERSION,3);
            ldap_set_option($ds,LDAP_OPT_REFERRALS,0);
            $dn="cn=".$cn.",dc=unet,dc=edu,dc=ve";
            $bind=ldap_bind($ds,$dn,$pwd);      
            if($bind){
                $busqueda = ldap_search($ds,$dominio,"uid=".$user);
                if($busqueda)
                { 
                    $info   = ldap_get_entries($ds,$busqueda);
                    
                    $login=$info[0]["dn"];
                    $bind2=@ldap_bind($ds,$login,$pass);
                    if($bind2){
                        $model = Yii::app()->user->um->loadUser($this->username);
                        if($model==null){
                            $usuarioNuevo = Yii::app()->user->um->createBlankUser();
                            $usuarioNuevo->username =$this->username;
                            $usuarioNuevo->email = $this->username."@unet.edu.ve";
                            Yii::app()->user->um->save($usuarioNuevo);
                            $nuevoUsuario = Yii::app()->user->um->loadUser($usuarioNuevo->username);
                            $this->_user = $nuevoUsuario;
                            $this->errorCode = self::ERROR_NONE; 
                        }else{
                            $this->_user = $model;
                            $this->errorCode = self::ERROR_NONE; 
                        }
                        //$this->errorCode = self::ERROR_NONE; 
                              
                    }
                    else{
                        $model = Yii::app()->user->um->loadUser($this->username);
                        if($model==null)
                           $this->errorCode=self::ERROR_USERNAME_INVALID;
                        else if($model->password!==$this->password)
                            $this->errorCode=self::ERROR_PASSWORD_INVALID;
                        else
                        {
                            $this->_user = $model;
                            $this->errorCode=self::ERROR_NONE;
                        }
                    }
                }
                else{

                
                        $this->errorCode=self::ERROR_USERNAME_INVALID;                  
                }
            }    
        }
        // en errorcode reporta el error generado
        //
        //$model = Yii::app()->user->um->loadUser($this->username);
        //$this->_user = $model;
        //$this->errorCode = self::ERROR_NONE; 
        //$this->errorCode = self::ERROR_USERNAME_INVALID;


        // retorna boolean, true si la autenticacion es exitosa
        //
        //return $this->errorCode == self::ERROR_NONE;
        return $this->errorCode == self::ERROR_NONE;
    }
}

