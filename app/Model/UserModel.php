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

use Hyperf\ModelCache\Cacheable;
use Hyperf\ModelCache\CacheableInterface;

class UserModel extends Model implements CacheableInterface
{
    use Cacheable;

    protected $primaryKey = 'id';

    protected $table = 'users';

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'remember_token',
        'create_time',
        'update_time',
        'delete_time',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'delete_time',
    ];
}
