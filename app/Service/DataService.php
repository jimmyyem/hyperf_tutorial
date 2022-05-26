<?php
/**
 *
 * @author yanhuaguo
 * @date 2022-05-15 10:51
 **/

namespace App\Service;

use App\Model\DataModel;
use Hyperf\Di\Annotation\Inject;

class DataService
{
    /**
     * @param $limit
     * @param $field
     * @param $order
     * @return mixed
     */
    public function getNew($limit = 10, $field = 'id', $order = 'desc') {
        return DataModel::orderBy($field, $order)->limit($limit)->get();
    }
}