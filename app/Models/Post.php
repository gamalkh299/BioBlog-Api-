<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use HasFactory, AsSource, Attachable;
    protected $table='posts';
    protected $fillable=['title','description','attachment_id','is_published','user_id'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');

    }

    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'attachment_id')->withDefault();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);

    }


}
