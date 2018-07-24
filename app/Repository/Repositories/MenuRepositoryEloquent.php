<?php

namespace App\Repository\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repository\Repositories\Interfaces\menuRepository;
use App\Repository\Models\Menu;
use App\Repository\Validators\MenuValidator;

/**
 * Class MenuRepositoryEloquent.
 *
 * @package namespace App\Repository\Repositories;
 */
class MenuRepositoryEloquent extends BaseRepository implements MenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
