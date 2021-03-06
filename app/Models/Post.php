<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use HasFactory, AsSource, Attachable,Filterable;
    protected $table='posts';
    protected $fillable=['title','description','image','is_published','user_id'];
    protected $allowedFilters = [
        'id',
        'title',
        'description',
        'image',
        'is_published',
        'user_id',
        'created_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'title',
        'description',
        'image',
        'created_at',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');

    }

    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'image')->withDefault();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'post_category');

    }

    public function comments()
    {
        return $this->hasMany(Comment::class);

    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'post_tag');

    }


    //--------------Scopes--------------//
    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('is_published','=',true);
    }

}
