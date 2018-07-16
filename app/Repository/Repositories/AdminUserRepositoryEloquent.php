<?php

namespace App\Repository\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repository\Repositories\Interfaces\AdminUserRepository;
use App\Repository\Models\AdminUser;

/**
 * Class AdminUserRepositoryEloquent.
 *
 * @package namespace App\Repository\Repositories;
 */
class AdminUserRepositoryEloquent extends BaseRepository implements AdminUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminUser::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Check login users account and password
     */
    public function checkLoginUser($info){
        $flag = false;
        $return = [];
        $getInfo = $this->findWhere(['email'=>$info['email']])->toArray();

        if (count($getInfo)>0){
            $password = md5($info['password']);
            if (isset($getInfo[0]['password']) && $getInfo[0]['password']==$password){
                $return = $getInfo[0];
                $flag = true;
            }
        }
        $return['flag'] = $flag;
        return $return;
    }
    
}
