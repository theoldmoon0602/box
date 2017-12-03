<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PasswordReset Entity
 *
 * @property int $id
 * @property string $email
 * @property string $token
 * @property \Cake\I18n\FrozenTime $created
 */
class PasswordReset extends Entity
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
        'email' => true,
        'token' => true,
        'created' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token'
    ];
}
