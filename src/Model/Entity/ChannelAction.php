<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use CakeWebsocket\Lib\WebsocketTrait;

/**
 * ChannelAction Entity.
 *
 * @property string $id
 * @property string $user_id
 * @property \App\Model\Entity\User $user
 * @property int $channel
 * @property string $state
 * @property \Cake\I18n\Time $execute_after
 * @property bool $locked
 * @property bool $executed
 * @property bool $error
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class ChannelAction extends Entity
{

    use WebsocketTrait;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    public function getPublisherClientIds($action = '')
    {
        switch ($action) {
            case 'add':
                return $this->getSocketSessionIds([
                    'Users.role' => 'admin'
                ]);
            default:
                return [];
        }
    }

    public function getPusblisherData()
    {
        $return = [
            'entity' => [
                'source' => $this->source()
            ],
        ];
        if (!empty($this->id)) {
            $return['entity']['id'] = $this->id;
        }
        return $return;
    }
}
