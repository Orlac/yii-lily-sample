<?php

$this->widget('zii.widgets.CDetailView', array(
    'data' => $data,
    'itemCssClass' => array(),
    'attributes' => array(
        'uid',
        'name',
        array(
            'label' => 'Birthday',
            'value' => $data->profile->birthday,
        ),
        array(
            'label' => 'Sex',
            'value' => $data->profile->sexOption,
        ),

        array(
            'label' => 'First tag',
            'value' => implode(', ',Tag1::model()->getTagsByUser($data->uid)),
        ),
        array(
            'label' => 'Second tag',
            'value' => implode(', ',Tag2::model()->getTagsByUser($data->uid)),
        ),
        array(
            'label' => 'Third tag',
            'value' => implode(', ',Tag3::model()->getTagsByUser($data->uid)),
        ),
//        'deleted',
//        'active',
//        'inited',
        array(
            'label' => LilyModule::t('Accounts'),
            'type' => 'raw',
            'value' => CHtml::link(LilyModule::t("Go to account list"), $this->createUrl("account/list", array('uid'=>$data->uid))),
        ),
        array(
            'type' => 'raw',
            'value' => $this->widget('zii.widgets.grid.CGridView', array(
                'dataProvider' => new CActiveDataProvider('LAccount', array(
                    'criteria' => array(
                        'condition' => 'uid=:uid AND hidden=0',
                        'params' => array(':uid' => $data->uid),
                        'order' => 'created ASC',
                    ),
                )),
                'enablePagination' => false,
                'summaryText' => '',
                'columns' => array(
                    array(
                        'name' => 'service',
                        'value' => '$data->serviceName',
                    ),
                    array(
                        'name' => 'id',
                        'value' => '$data->displayId',
                    ),
                    array(
                        'name' => 'created',
                        'value' => 'Yii::app()->dateFormatter->formatDateTime($data->created)',
                    ),
                ),
                    ), true)
        ,
        ),
    ),
));