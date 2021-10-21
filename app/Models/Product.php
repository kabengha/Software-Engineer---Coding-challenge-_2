<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    public $guarded = [];

    protected $table = 'products';

    protected $casts = [
        'image'   => 'json'
    ];

    /**
     * @return belongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
