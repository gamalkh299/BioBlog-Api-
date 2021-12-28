<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;

class Team extends Model
{
    use HasFactory,Filterable;
    protected $fillable=[
            'name',
            'image',
            'job',
            'twitter',
            'facebook',
            'whatsapp'
    ];
    protected $allowedFilters = [
        'id',
        'name',
        'image',
        'job',
        'twitter',
        'facebook',
        'whatsapp',
        'created_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'image',
        'job',
        'twitter',
        'facebook',
        'whatsapp',
        'created_at',
    ];
    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'image')->withDefault();
    }




}
