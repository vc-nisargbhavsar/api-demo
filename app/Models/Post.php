<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Post extends Model
{
    use HasApiTokens, HasFactory;

    protected $table ='post';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'caption',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
}
