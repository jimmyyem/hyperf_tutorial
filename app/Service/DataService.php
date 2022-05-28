<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Service;

use App\Model\DataModel;

class DataService
{
    /**
     * @param $limit
     * @param $field
     * @param $order
     * @return mixed
     */
    public function getNew($limit = 10, $field = 'id', $order = 'desc')
    {
        return DataModel::orderBy($field, $order)->limit($limit)->get();
    }
}
