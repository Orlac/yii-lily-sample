<?php
/**
 * Profile class file.
 *
 * @author George Agapov <george.agapov@gmail.com>
 * @link https://github.com/georgeee/yii-lily-sample
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * Profile is a model class.
 * It deals with user profile data.
 *
 * @property integer $pid Profile's id
 * @property integer $uid User's id
 * @property string $name User's name
 * @property boolean $sex User's sex (0 - female, 1 - male)
 * @property string $birthday User's birthday date (see $userPatterns for more info, it should be compatible with jQueryUI's Datepicker)
 *
 * @property array $sexOptions Sex field options
 *
 * @package application.models
 */
class Profile extends LUserModel {
/**
 * Format, in which date should be saved to DB
 */
    const dbPattern = "yyyy-MM-dd";
/**
 * @var string current user date pattern
 */
    public $userPattern;
    /**
     * @var array user date patterns (keyed by locale ids)
     */
    public $userPatterns = array(
        'en' => 'MM/dd/yyyy',
        'ru' => 'dd.MM.yyyy',
    );

    /**
     * Simple constructs new Profile instance
     * @param string $scenario
     */
    public function __construct($scenario = 'insert')
    {
        $this->userPattern = $this->userPatterns[Yii::app()->locale->id];
        return parent::__construct($scenario);
    }

    /**
     * Callback for user name
     * @static
     * @param LUser $user
     * @return null
     */
    public static function getUserName(LUser $user){
    	return isset($user->profile->name) ? $user->profile->name : null;
    }
    /**
     * afterValidate handler
     */
    protected function afterValidate() {
        $this->birthday = $this->convertBirthdayDbToLocaled($this->birthday);
        parent::afterValidate();
    }

    /**
     * afterFind handler
     */
    protected function afterFind() {
        $this->birthday = $this->convertBirthdayDbToLocaled($this->birthday);
        parent::afterFind();
    }

    /**
     * afterSave handler
     */
    protected function afterSave() {
        $this->birthday = $this->convertBirthdayDbToLocaled($this->birthday);
        parent::afterSave();
    }
    /**
     * beforeValidate handler
     * @return bool
     */
    protected function beforeValidate() {
        $this->birthday = $this->convertBirthdayLocaledToDb($this->birthday);
        return parent::beforeValidate();
    }

    /**
     * beforeFind handler
     * @return bool
     */
    protected function beforeFind() {
        $this->birthday = $this->convertBirthdayLocaledToDb($this->birthday);
        return parent::beforeFind();
    }

    /**
     * beforeSave handler
     * @return bool
     */
    protected function beforeSave() {
        $this->birthday = $this->convertBirthdayLocaledToDb($this->birthday);
        return parent::beforeSave();
    }

    protected $_sexOptions = null;

    /**
     * Getter for sexOptions property
     * @return array sex options
     */
    public function getSexOptions() {
        if (!isset($this->_sexOptions))
            $this->_sexOptions = array(
                1 => 'Male',
                0 => 'Female',
            );
        return $this->_sexOptions;
    }

    /**
     * Sex option getter
     * @param int $sex sex id (see sex property)
     * @return string
     */
    public function getSexOption($sex = null) {
        if (!isset($sex))
            $sex = $this->sex;
        return $this->sexOptions[(int) $sex];
    }

    /**
     * Converts date from db format to user
     * @param string $date
     * @return string converted date
     */
    public function convertBirthdayDbToLocaled($date) {
        $timestamp = CDateTimeParser::parse($date, self::dbPattern);
        if ($timestamp === false)
            return null;
        else
            return Yii::app()->dateFormatter->format($this->userPattern,$timestamp);
    }

    /**
     * Converts date from user format to db
     * @param string $date
     * @return string converted date
     */
    public function convertBirthdayLocaledToDb($date) {
        $timestamp = CDateTimeParser::parse($date, $this->userPattern);
        if ($timestamp === false)
            return null;
        else
            return Yii::app()->dateFormatter->format(self::dbPattern, $timestamp);
    }
    /**
     * Sets birthday property by the specified timestamp
     * @param int $timestamp
     */
    public function setBirthdayByTimestamp($timestamp){
        $this->birthday = Yii::app()->dateFormatter->format($this->userPattern,$timestamp);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{profile}}';
    }
    /**
     * CActiveRecord relations
     * @return array relations
     */
    public function relations() {
        return array(
            'user' => array(self::BELONGS_TO, 'LUser', 'uid'),
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Tag the static model class
     */
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

    /**
     * @return array validation rules for model attributes.
     */
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
