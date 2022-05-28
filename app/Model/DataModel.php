<?php
/**
 * @date 2022-05-15 10:51
 */
declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Model;

class DataModel extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'data';

    protected $fillable = [
        'id',
        'data',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
    ];
}
