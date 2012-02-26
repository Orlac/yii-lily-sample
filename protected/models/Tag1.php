<?php
/**
 * Tag1 class file.
 *
 * @author George Agapov <george.agapov@gmail.com>
 * @link https://github.com/georgeee/yii-lily-sample
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * Tag1 is a model class.
 *
 * @property integer $tid Tag id
 * @property string $name Tag name
 *
 * @package application.models
 */
class Tag1 extends Tag
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
        return '{{tag1}}';
    }
    /**
     * @return string the associated database realtional table name (for MANY_MANY)
     */
    public function relationTableName()
    {
        return '{{tag1_relation}}';
    }
    /**
     * @return string class name
     */
    public function getClassName(){
        return __CLASS__;
    }
}