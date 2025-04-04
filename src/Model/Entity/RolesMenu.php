<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RolesMenu Entity
 *
 * @property int $id
 * @property int $role_id
 * @property int $menu_id
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Menu $menu
 */
class RolesMenu extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'role_id' => true,
        'menu_id' => true,
        'role' => true,
        'menu' => true,
    ];
}
