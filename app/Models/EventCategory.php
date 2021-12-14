<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasFactory;
    public $table = 'event_categories';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'category_id',
    ];
}
