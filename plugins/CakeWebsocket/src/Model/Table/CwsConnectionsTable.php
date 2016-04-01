<?php
namespace CakeWebsocket\Model\Table;

use CakeWebsocket\Model\Entity\CwsConnection;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CwsConnections Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ressources
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class CwsConnectionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('cws_connections');
        $this->displayField('ressource_id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');


        $this->belongsTo('Users');
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
            ->uuid('id')
            ->allowEmpty('id', 'create');

        return $validator;
    }

    public function add($connection, $sessionId, $userId)
    {
        if ($this->exists(['ressource_id' =>  $connection->wrappedConn->WAMP->sessionId])) {
            return false;
        }
        $connection = $this->newEntity([
            'ressource_id' =>  $connection->wrappedConn->WAMP->sessionId,
            'session_id' => $sessionId,
            'user_id' => $userId
        ]);

        $return = $this->save($connection);
        return $return;
    }

    public function remove($connection)
    {
        $connection = $this->find()->where(['ressource_id' =>  $connection->wrappedConn->WAMP->sessionId])->first();
        if (empty($connection)) {
            return false;
        }
        return $this->delete($connection);
    }

}
