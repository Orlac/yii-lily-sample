<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => 'Lily (module itself)',
        ));
        $this->widget('zii.widgets.CMenu', array(
            'items' => array(
                array('label' => 'Current user', 'url' => array('/lily/user/view')),
                array('label' => 'All users', 'url' => array('/lily/user/list')),
                array('label' => 'List accounts', 'url' => array('/lily/account/list')),
                array('label' => 'Bind an account', 'url' => array('/lily/account/bind')),
            ),
            'htmlOptions' => array('class' => 'operations'),
        ));
        $this->endWidget();
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => 'Profile & Tags',
        ));
        $this->widget('zii.widgets.CMenu', array(
            'items' => array(
                array('label' => 'Edit profile', 'url' => array('/profile/edit')),
                array('label' => 'Edit tags', 'url' => array('/tag/edit')),
            ),
            'htmlOptions' => array('class' => 'operations'),
        ));
        $this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>