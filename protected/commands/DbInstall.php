<?php
/**
 * DbInstall class file.
 *
 * @author George Agapov <george.agapov@gmail.com>
 * @link https://github.com/georgeee/yii-lily-sample
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * DbInstall is a console command class.
 * It provides interface for installing DB schema.
 *
 * @package application.commands
 */

class DbInstall extends CConsoleCommand
{
    /**
     * @var array ids of connections, on which installation process should be populated
     */
    public $connectionIds = array('db');

    /**
     * index action (the only action of the command
     */
    public function actionIndex(){
        foreach ($this->connectionIds as $id) $this->exec($id);
    }
/**
 * This function performs installation (everything happens here)
 * @param string $connectionId
 */
    private function exec($connectionId){
        $db = Yii::app()->$connectionId;

//        $sql_text = file_get_contents(Yii::getFrameworkPath(). DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'auth'.DIRECTORY_SEPARATOR.'schema-'.$db->driverName.'.sql');
//        $sql_text = preg_replace('~/\*((.(?!\*/))*.)?\*/~ims', '', $sql_text);
//        $sqls = preg_split('~\;~', $sql_text, PREG_SPLIT_NO_EMPTY);
//        foreach($sqls as $sql){
//            $db->createCommand($sql)->execute();
//        }

        $runner = new CConsoleCommandRunner();
        $commandPath = Yii::getFrameworkPath() . DIRECTORY_SEPARATOR . 'cli' . DIRECTORY_SEPARATOR . 'commands';
        $runner->addCommands($commandPath);
        $runner->run(array('yiic', 'migrate', '--interactive=0', '--connectionID='.$connectionId));
        $runner->run(array('yiic', 'migrate', '--interactive=0', '--migrationPath=application.modules.lily.migrations', '--connectionID='.$connectionId));


    }
}
