<?php
/**
 *
 * @author yanhuaguo
 * @date 2022-05-14 18:16
 **/

namespace App\Service;

use Hyperf\Di\Annotation\Inject;

class UserService
{
    /**
     * @Inject()
     * @var \App\Model\UserModel
     */
    protected $model;

    /**
     * 获取用户信息
     *
     * @param int|string $id
     * @return array|null
     */
    public function getInfoById(int|string $id): array|null
    {
        $user = $this->model->find($id);
        if ($user) {
            return $user->toArray();
        }

        return null;
    }
}