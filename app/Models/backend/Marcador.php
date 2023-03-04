<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marcador extends Model
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
        'metadata' => 'array',
        'activo' => 'boolean',
    ];

    public function xPosts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'marcadorable');
    }

    public function xVideos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'marcadorable');
    }

    public function xImagens(): MorphToMany
    {
        return $this->morphedByMany(Imagen::class, 'marcadorable');
    }

    public function xMovimientos(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\banca\Movimiento::class, 'marcadorable');
    }
}
