<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;

class Category extends Model
{
    use HasFactory;

    protected $fillable=['name','description','attachment_id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'attachment_id')->withDefault();
    }
}
