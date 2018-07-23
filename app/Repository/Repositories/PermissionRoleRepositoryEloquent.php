<?php

namespace App\Repository\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repository\Repositories\Interfaces\permission_roleRepository;
use App\Repository\Models\PermissionRole;
use App\Repository\Validators\PermissionRoleValidator;

/**
 * Class PermissionRoleRepositoryEloquent.
 *
 * @package namespace App\Repository\Repositories;
 */
class PermissionRoleRepositoryEloquent extends BaseRepository implements PermissionRoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PermissionRole::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
