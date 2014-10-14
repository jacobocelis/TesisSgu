<?php

/**
 * This is the model class for table "cruge_system".
 *
 * The followings are the available columns in table 'cruge_system':
 * @property integer $idsystem
 * @property string $name
 * @property string $largename
 * @property integer $sessionmaxdurationmins
 * @property integer $sessionmaxsameipconnections
 * @property integer $sessionreusesessions
 * @property integer $sessionmaxsessionsperday
 * @property integer $sessionmaxsessionsperuser
 * @property integer $systemnonewsessions
 * @property integer $systemdown
 * @property integer $registerusingcaptcha
 * @property integer $registerusingterms
 * @property string $terms
 * @property integer $registerusingactivation
 * @property string $defaultroleforregistration
 * @property string $registerusingtermslabel
 * @property integer $registrationonlogin
 */
class CrugeSystem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cruge_system';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sessionmaxdurationmins, sessionmaxsameipconnections, sessionreusesessions, sessionmaxsessionsperday, sessionmaxsessionsperuser, systemnonewsessions, systemdown, registerusingcaptcha, registerusingterms, registerusingactivation, registrationonlogin', 'numerical', 'integerOnly'=>true),
			array('name, largename', 'length', 'max'=>45),
			array('defaultroleforregistration', 'length', 'max'=>64),
			array('registerusingtermslabel', 'length', 'max'=>100),
			array('terms', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idsystem, name, largename, sessionmaxdurationmins, sessionmaxsameipconnections, sessionreusesessions, sessionmaxsessionsperday, sessionmaxsessionsperuser, systemnonewsessions, systemdown, registerusingcaptcha, registerusingterms, terms, registerusingactivation, defaultroleforregistration, registerusingtermslabel, registrationonlogin', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idsystem' => 'Idsystem',
			'name' => 'Name',
			'largename' => 'Largename',
			'sessionmaxdurationmins' => 'Sessionmaxdurationmins',
			'sessionmaxsameipconnections' => 'Sessionmaxsameipconnections',
			'sessionreusesessions' => 'Sessionreusesessions',
			'sessionmaxsessionsperday' => 'Sessionmaxsessionsperday',
			'sessionmaxsessionsperuser' => 'Sessionmaxsessionsperuser',
			'systemnonewsessions' => 'Systemnonewsessions',
			'systemdown' => 'Systemdown',
			'registerusingcaptcha' => 'Registerusingcaptcha',
			'registerusingterms' => 'Registerusingterms',
			'terms' => 'Terms',
			'registerusingactivation' => 'Registerusingactivation',
			'defaultroleforregistration' => 'Defaultroleforregistration',
			'registerusingtermslabel' => 'Registerusingtermslabel',
			'registrationonlogin' => 'Registrationonlogin',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idsystem',$this->idsystem);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('largename',$this->largename,true);
		$criteria->compare('sessionmaxdurationmins',$this->sessionmaxdurationmins);
		$criteria->compare('sessionmaxsameipconnections',$this->sessionmaxsameipconnections);
		$criteria->compare('sessionreusesessions',$this->sessionreusesessions);
		$criteria->compare('sessionmaxsessionsperday',$this->sessionmaxsessionsperday);
		$criteria->compare('sessionmaxsessionsperuser',$this->sessionmaxsessionsperuser);
		$criteria->compare('systemnonewsessions',$this->systemnonewsessions);
		$criteria->compare('systemdown',$this->systemdown);
		$criteria->compare('registerusingcaptcha',$this->registerusingcaptcha);
		$criteria->compare('registerusingterms',$this->registerusingterms);
		$criteria->compare('terms',$this->terms,true);
		$criteria->compare('registerusingactivation',$this->registerusingactivation);
		$criteria->compare('defaultroleforregistration',$this->defaultroleforregistration,true);
		$criteria->compare('registerusingtermslabel',$this->registerusingtermslabel,true);
		$criteria->compare('registrationonlogin',$this->registrationonlogin);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CrugeSystem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
