<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Comment extends Model
{
    use HasFactory,Filterable;

    protected $table='comments';
    protected $fillable=['comment','user_id','post_id'];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'comment',
        'created_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'comment',
        'created_at',
    ];


    public function post()
    {
        return $this->belongsTo(Post::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
