<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\I18n\Time;

/**
 * ResetFailedLoginLock shell command.
 */
class ChannelActionsDaemonShell extends Shell
{

    public $Channel = null;

    /**
     * main() method.
     *
     * @return void
     */
    public function main()
    {
        if (is_null($this->args[0])) {
            return $this->error('Please enter a channel. [1,2,3,4]');
        }
        $this->Channel = (int)$this->args[0];
        $this->Channel--;
        $this->loadModel('ChannelActions');
        $this->out(date('Y-m-d H:i:s') . ': Started deamon for channel ' . ($this->Channel + 1) . '.');
        while(true){
            $this->_processNextAction();
            usleep(250000);
        }
    }

    protected function _processNextAction()
    {
        $nextAction = $this->ChannelActions->getNextActionForChannel($this->Channel);
        if (!empty($nextAction)) {
            $this->out('---------------------------------------------------------------');
            $this->out($this->_getTimestamp() . ': Channel ' . ($nextAction->channel + 1) . ' will be turned ' . $nextAction->state . ' ...');
            $this->ChannelActions->executeAction($nextAction);
            $this->out($this->_getTimestamp() . ': Channel ' . ($nextAction->channel + 1) . ' has been turned ' . $nextAction->state . ' ...');
        }
    }

    protected function _getTimestamp()
    {
        return date('Y-m-d\TH:i:s') . substr((string)microtime(), 1, 8);
    }
}
