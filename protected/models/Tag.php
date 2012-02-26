<?php

/**
 * Tag class file.
 *
 * @author George Agapov <george.agapov@gmail.com>
 * @link https://github.com/georgeee/yii-lily-sample
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * Tag is a model class, sceleton for Tag1, Tag2, Tag3.
 *
 * @property integer $tid Tag id
 * @property string $name Tag name
 *
 * @package application.models
 */
class Tag extends LUserModel
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
        return '{{tag}}';
    }
    /**
     * @return string the associated database table name
     */
    public function relationTableName()
    {
        return '{{tag_relation}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            // Please remove those attributes that should not be searched.
            array('name', 'safe', 'on'=>'search'),
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
            'users' => array(CActiveRecord::MANY_MANY, 'LUser', $this->relationTableName().'(tid, uid)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'tid' => 'Tag id',
            'name' => 'Name',
        );
    }
    /**
     * @return string class name
     */
    public function getClassName(){
        return __CLASS__;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('name',$this->name,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    /**
     * Finds a tag with specified name or creates a new one
     * @param string $name
     * @return Tag tag with specified name
     */
    public function getByName($name){
        $className = $this->className;
        $tag = self::model($className)->findByAttributes(array('name' => $name));
        if(!isset($tag)){
            $tag = new $className;
            $tag->name = $name;
            $tag->save();
        }
        return $tag;
    }
    /**
     * Attaches $this tag to specified user
     * @param int $uid User id
     */
    public function attachToUser($uid){
        $command = $this->getDbConnection()->createCommand();
        $command->insert($this->relationTableName(), array('tid'=>$this->tid, 'uid'=>$uid));
    }
    /**
     * Detaches $this tag from specified user
     * @param int $uid User id
     */
    public function detachFromUser($uid){
        $command = $this->getDbConnection()->createCommand();
        $command->delete($this->relationTableName(), 'tid=:tid AND uid=:uid', array(':tid'=>$this->tid, ':uid'=>$uid));
    }

    /**
     * Detaches all tags from specified user
     * @param int $uid User id
     */
    public function detachAllTagsFromUser($uid){
        $command = $this->getDbConnection()->createCommand();
        $command->delete($this->relationTableName(), 'uid=:uid', array(':uid'=>$uid));
    }

    /**
     * Returns array of tag names, that are attached to specified user
     * @param int $uid User id
     * @return array tag names
     */
    public function getTagsByUser($uid){
        $command = $this->dbConnection->createCommand();
        $command->select('t.name');
        $command->from($this->relationTableName().' r');
        $command->where('r.uid = :uid', array(':uid'=>$uid));
        $command->join($this->tableName().' t', 'r.tid = t.tid');
        return $command->queryColumn();
    }
}