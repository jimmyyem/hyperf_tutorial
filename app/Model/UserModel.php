<?php
/**
 *
 * @author yanhuaguo
 * @date 2022-05-15 10:51
 **/
declare(strict_types=1);

namespace App\Model;

class UserModel extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'users';

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