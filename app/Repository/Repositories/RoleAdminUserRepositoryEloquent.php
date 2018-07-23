<?php

namespace App\Repository\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repository\Repositories\Interfaces\role_admin_userRepository;
use App\Repository\Models\RoleAdminUser;
use App\Repository\Validators\RoleAdminUserValidator;

/**
 * Class RoleAdminUserRepositoryEloquent.
 *
 * @package namespace App\Repository\Repositories;
 */
class RoleAdminUserRepositoryEloquent extends BaseRepository implements RoleAdminUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoleAdminUser::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
