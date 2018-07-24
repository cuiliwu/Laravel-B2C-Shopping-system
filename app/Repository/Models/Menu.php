<?php

namespace App\Repository\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Menu.
 *
 * @package namespace App\Repository\Models;
 */
class Menu extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','icon','order','parent_id','uri','created_at','updated_at','hide'];
    protected $appends = ['menu_id'];
    
    public function getMenuIdAttribute($val){
        return $this->id;
    }
}
