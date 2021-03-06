<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class ContactUs extends Model
{
    use HasFactory,Filterable;

    protected $fillable=[
        'name',
        'email',
        'phone',
        'message'
    ];

    protected $allowedFilters = [
        'name',
        'email',
        'phone',
        'message'
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'name',
        'email',
        'phone',
        'message'
    ];

}
