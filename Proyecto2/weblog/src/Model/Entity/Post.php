<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property string $title
 * @property string $abstract
 * @property string $text
 * @property int $author_id
 * @property int $category_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Comment[] $comments
 */
class Post extends Entity
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
        'created' => true,
        'title' => true,
        'abstract' => true,
        'text' => true,
        'author_id' => true,
        'category_id' => true,
        'user' => true,
        'category' => true,
        'comments' => true,
    ];
}
