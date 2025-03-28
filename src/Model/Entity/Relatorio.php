<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Relatorio Entity
 *
 * @property int $id
 * @property string $titulo
 * @property string|null $descricao
 * @property \Cake\I18n\DateTime $data_criacao
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime|null $updated
 */
class Relatorio extends Entity
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
        'titulo' => true,
        'descricao' => true,
        'data_criacao' => true,
        'link_iframe' => true,
        'created' => true,
        'updated' => true,
    ];
}
