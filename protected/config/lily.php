<?php
return array(
    'class' => 'lily.LilyModule',
    'relations' => array(
        'profile' => array(
            'relation' => array(CActiveRecord::HAS_ONE, 'Profile', 'uid'),
            'onUserMerge' => 'auto', //just updates indexes from old uid to new one
            'onRegister' => array('profile/edit'), //null isn't required
        ),
        'tags1' => array(
            'relation' => array(CActiveRecord::MANY_MANY, 'Tag1', '{{tag1_relation}}(uid, tid)'),
            'onUserMerge' => 'auto', //just updates indexes from old uid to new one
        ),
        'tags2' => array(
            'relation' => array(CActiveRecord::MANY_MANY, 'Tag2', '{{tag2_relation}}(uid, tid)'),
            'onUserMerge' => 'callback', //callback - execute callback from callback property
            'callback' => array('Tag2','userMergeCallback')
        ),
        'tags3' => array(
            'relation' => array(CActiveRecord::MANY_MANY, 'Tag3', '{{tag3_relation}}(uid, tid)'),
            'onUserMerge' => 'event', //event - raise event accross the model, auto, null - do nothing
        ),
    ),
    'userNameFunction' => array('Profile', 'getUserName'), //callback, that should return name of the user
);