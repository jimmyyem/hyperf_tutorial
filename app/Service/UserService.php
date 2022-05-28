<?php
/**
 *
 * @author yanhuaguo
 * @date 2022-05-14 18:16
 **/

namespace App\Service;

use App\Model\UserModel;
use Hyperf\Cache\Annotation\Cacheable;

class UserService
{
    /**
     * @param $id
     * @return mixed
     */
    #[Cacheable(prefix: "user_detail", ttl:90, listener:"user-update")]
    public function getUser($id)
    {
        $user = UserModel::find($id);
        if (empty($user)) {
            return null;
        }

        return $user->toArray();
    }
}