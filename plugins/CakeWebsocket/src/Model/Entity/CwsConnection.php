<?php
namespace CakeWebsocket\Model\Entity;

use Cake\ORM\Entity;

/**
 * CwsConnection Entity.
 *
 * @property string $id
 * @property string $ressource_id
 * @property \CakeWebsocket\Model\Entity\Ressource $ressource
 * @property string $session_id
 * @property \CakeWebsocket\Model\Entity\Session $session
 * @property string $user_id
 * @property \CakeWebsocket\Model\Entity\User $user
 * @property \Cake\I18n\Time $created
 */
class CwsConnection extends Entity
{

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
}
