<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    protected $table = "events";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image_url',
        'category_id',
        'date_start',
        'date_end',
    ];




    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
