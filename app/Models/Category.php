<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;

class Category extends Model
{
    use HasFactory,Filterable,Attachable;


    protected $fillable=['name','description','image'];
    protected $allowedFilters = [
        'id',
        'name',
        'description',
        'image',
        'created_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'description',
        'image',
        'created_at',
    ];
    public function posts()
    {
        return $this->belongsToMany(Post::class,'post_category');
    }

    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'image')->withDefault();
    }
}
