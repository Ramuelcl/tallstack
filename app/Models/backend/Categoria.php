<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'categoriaable');
    }

    public function videos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'categoriaable');
    }

    public function imagens(): MorphToMany
    {
        return $this->morphedByMany(Imagen::class, 'categoriaable');
    }
}
