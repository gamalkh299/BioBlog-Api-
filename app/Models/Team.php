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
            'attachment_id',
            'job',
            'twitter',
            'facebook',
            'whatsapp'
    ];
    protected $allowedFilters = [
        'id',
        'name',
        'attachment_id',
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
        'attachment_id',
        'job',
        'twitter',
        'facebook',
        'whatsapp',
        'created_at',
    ];
    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'attachment_id')->withDefault();
    }




}
