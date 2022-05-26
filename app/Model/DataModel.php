<?php
/**
 *
 * @author yanhuaguo
 * @date 2022-05-15 10:51
 **/
declare(strict_types=1);

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