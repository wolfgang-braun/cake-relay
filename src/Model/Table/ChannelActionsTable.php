<?php
namespace App\Model\Table;

use App\Model\Entity\ChannelAction;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\I18n\Time;
use Cake\Validation\Validator;
use CakeWebsocket\Lib\SocketPublisher;
use WolfgangBraun\PiRelay\PiRelay;

/**
 * ChannelActions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class ChannelActionsTable extends Table
{

    public $PiRelay;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('channel_actions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->PiRelay = new PiRelay(null, null, 0);
        $this->PiRelay->setSSHconfig('192.168.178.32', 'relay', '/Users/fuco/id_rsa');

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'uuid'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('channel', 'valid', ['rule' => 'numeric'])
            ->requirePresence('channel', 'create')
            ->notEmpty('channel');

        $validator
            ->requirePresence('state', 'create')
            ->notEmpty('state');

        $validator
            ->add('execute_after', 'valid', ['rule' => 'datetime'])
            ->requirePresence('execute_after', 'create')
            ->notEmpty('execute_after');

        $validator
            ->add('locked', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('locked');

        $validator
            ->add('executed', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('executed');

        $validator
            ->add('error', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('error');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    public function onOff($channel, $duration, $userId)
    {
        $actionOn = $this->newEntity([
            'user_id' => $userId,
            'channel' => $channel,
            'state' => PiRelay::STATE_ON,
            'execute_after' => new Time(date("Y-m-d H:i:s", strtotime( '+' . 1 . ' second' )))
        ]);
        if ($this->save($actionOn)) {
            (new SocketPublisher($actionOn, 'add', ['felix' => 'toll']))->send();
            $actionOff = $this->newEntity([
                'user_id' => $userId,
                'channel' => $channel,
                'state' => PiRelay::STATE_OFF,
                'execute_after' => new Time(date("Y-m-d H:i:s", strtotime( '+' . ($duration + 1) . ' second' )))
            ]);
            if ($this->save($actionOff)) {
                return true;
            }
        }
        return false;
    }

    public function getNextActionForChannel($channel)
    {
        return $this->find()->where([
                'locked' => false,
                'executed' => false,
                'error' => false,
                'channel' => $channel,
                'execute_after' => date('Y-m-d H:i:s')
            ])
            ->order(['execute_after ASC'])
            ->first();
    }

    public function executeAction($action)
    {
        $this->patchEntity($action, ['locked' => true]);
        $this->save($action);
        try {
            $this->PiRelay->setState($action->channel, $action->state);
            $this->patchEntity($action, [
                'locked' => false,
                'executed' => true
            ]);
            $this->save($action);
        } catch (\BadFunctionCallException $e) {
            $this->patchEntity($action, [
                'locked' => false,
                'error' => true
            ]);
            $this->save($action);
        }
    }

}
