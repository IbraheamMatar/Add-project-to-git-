<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Store extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'title', 'content', 'category_id', 'featrued','slug'
    ];

    protected $dates = ['deleted_at'];



    public function getFeatruedAttribute($featrued)
    {
        return asset($featrued);
    }





    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
