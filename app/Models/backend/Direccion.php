<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Direccion extends Model
{
    use HasFactory;

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
        'ciudad_id' => 'integer',
    ];

    public function xClientes(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\ventas\Cliente::class, 'direccionable');
    }

    public function xVendedors(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\compras\Vendedor::class, 'direccionable');
    }

    public function ciudad(): BelongsTo
    {
        return $this->belongsTo(Ciudad::class);
    }
}
