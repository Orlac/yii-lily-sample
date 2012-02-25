<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profile
 * @property integer $pid Profile's id
 * @property integer $uid User's id
 * @property string $name User's name
 * @property boolean $sex User's sex (0 - female, 1 - male)
 * @property string $birthday User's birthday date
 * @author georgeee
 */
class Profile extends LUserModel {

    const dbPattern = "yyyy-MM-dd";

    public $userPattern;

    public function __construct($scenario = 'insert')
    {
        $userPatterns = array(
            'en' => 'MM/dd/yyyy',
            'ru' => 'dd.MM.yyyy',
        );
        $this->userPattern = $userPatterns[Yii::app()->locale->id];
        return parent::__construct($scenario);
    }


    public static function getUserName(LUser $user){
    	return isset($user->profile->name) ? $user->profile->name : null;
    }
    
    protected function afterValidate() {
        $this->birthday = $this->convertBirthdayDbToLocaled($this->birthday);
        parent::afterValidate();
    }

    protected function afterFind() {
        $this->birthday = $this->convertBirthdayDbToLocaled($this->birthday);
        parent::afterFind();
    }

    protected function afterSave() {
        $this->birthday = $this->convertBirthdayDbToLocaled($this->birthday);
        parent::afterSave();
    }

    protected function beforeValidate() {
        $this->birthday = $this->convertBirthdayLocaledToDb($this->birthday);
        return parent::beforeValidate();
    }

    protected function beforeFind() {
        $this->birthday = $this->convertBirthdayLocaledToDb($this->birthday);
        return parent::beforeFind();
    }

    protected function beforeSave() {
        $this->birthday = $this->convertBirthdayLocaledToDb($this->birthday);
        return parent::beforeSave();
    }

    protected $_sexOptions = null;

    public function getSexOptions() {
        if (!isset($this->_sexOptions))
            $this->_sexOptions = array(
                1 => 'Male',
                0 => 'Female',
            );
        return $this->_sexOptions;
    }

    public function getSexOption($sex = null) {
        if (!isset($sex))
            $sex = $this->sex;
        return $this->sexOptions[(int) $sex];
    }

    public function convertBirthdayDbToLocaled($date) {
        $timestamp = CDateTimeParser::parse($date, self::dbPattern);
        if ($timestamp === false)
            return null;
        else
            return Yii::app()->dateFormatter->format($this->userPattern,$timestamp);
    }

    public function convertBirthdayLocaledToDb($date) {
        $timestamp = CDateTimeParser::parse($date, $this->userPattern);
        if ($timestamp === false)
            return null;
        else
            return Yii::app()->dateFormatter->format(self::dbPattern, $timestamp);
    }

    public function tableName() {
        return '{{profile}}';
    }

    public function relations() {
        return array(
            'user' => array(self::BELONGS_TO, 'LUser', 'uid'),
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * onUserMerge event handler
     * @param CModelEvent $event 
     */
    public function onUserMerge($event) {
        if ($this->uid != $event->params['newId'])
            $this->delete();
        //raises event on the component (someone can bind a handler to this model)
        parent::onUserMerge($event);
    }

    public function rules() {
        return array(
            array('name, sex, birthday', 'required'),
            array('sex', 'boolean', 
                'message' => LilyModule::t("Please specify your sex (either male or female)."),
                ),
            array('name', 'length', 'max' => 255),
            array('birthday', 'date', 'format' => self::dbPattern),
        );
    }

}

?>
