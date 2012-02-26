<?php
/**
 * TagForm class file.
 *
 * @author George Agapov <george.agapov@gmail.com>
 * @link https://github.com/georgeee/yii-lily-sample
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * TagForm is a model class, that handles with tags edit form.
 *
 * @property integer $tid Tag id
 * @property string $name Tag name
 *
 * @package application.models
 */
class TagForm extends CFormModel
{
    /**
     * @var string tag1 field
     */
    public $tag1;
    /**
     * @var string tag2 field
     */
    public $tag2;
    /**
     * @var string tag3 field
     */
    public $tag3;

    /**
     * Declares the validation rules.
     * @return array validation rules
     */
    public function rules()
    {
        return array(
            array('tag1, tag2, tag3', 'safe'),
        );
    }
    /**
     * saves tag field to user
     * @param string $tagClass Tag class name
     * @param int $uid User id
     * @param string $data tag data
     */
    protected function saveTagsToUser($tagClass, $uid, $data){
        $tags = preg_split('~\s*,\s*~', $data, null, PREG_SPLIT_NO_EMPTY);
        $model = $tagClass::model();
        $model->detachAllTagsFromUser($uid);
        foreach($tags as $tagName){
            $tag = $model->getByName($tagName);
            $tag->attachToUser($uid);
        }
    }

    /**
     * Saves all tag fields to specified user
     * @param int $uid User id
     */
    public function saveToUser($uid){
        $this->saveTagsToUser('Tag1', $uid, $this->tag1);
        $this->saveTagsToUser('Tag2', $uid, $this->tag2);
        $this->saveTagsToUser('Tag3', $uid, $this->tag3);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'tag1' => "First tag",
            'tag2' => "Second tag",
            'tag3' => "Third tag",
        );
    }

}
