<?php
namespace Api\Controller;

use CkTools\Lib\ApiReturnCode;

/**
 * ChannelActions Controller
 *
 * @property \App\Model\Table\ChannelActionsTable $ChannelActions
 */
class ChannelActionsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function onOff($channel, $duration)
    {
        $this->loadModel('App.ChannelActions');
        $this->request->allowMethod('get');
        if ($this->ChannelActions->onOff($channel, $duration, $this->Auth->user('id'))) {
            return $this->Api->response(ApiReturnCode::SUCCESS);
        } else {
            return $this->Api->response(ApiReturnCode::INTERNAL_ERROR);
        }
    }
}
