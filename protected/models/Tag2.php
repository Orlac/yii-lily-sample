<?php
/**
 * Tag2 class file.
 *
 * @author George Agapov <george.agapov@gmail.com>
 * @link https://github.com/georgeee/yii-lily-sample
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * Tag2 is a model class.
 *
 * @property integer $tid Tag id
 * @property string $name Tag name
 *
 * @package application.models
 */
class Tag2 extends Tag
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tag the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{tag2}}';
    }
    /**
     * @return string the associated database table name
     */
    public function relationTableName()
    {
        return '{{tag2_relation}}';
    }
    /**
     * callback for user merging
     * @static
     * @param LMergeEvent $event
     */
    public static function userMergeCallback(LMergeEvent $event){
        $model = Tag2::model();
        $model->dbConnection->createCommand()->delete($model->relationTableName(), 'uid=:uid', array(':uid'=>$event->oldUid));
    }
    /**
     * @return string class name
     */
    public function getClassName(){
        return __CLASS__;
    }
}