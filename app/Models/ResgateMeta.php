<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResgateMeta extends Model
{
    use HasFactory;

    protected $table = 'resgates_metas';

    protected $fillable = [
        'user_id',
        'meta_id',
        'status',
        'valor_bonus',
    ];

    protected $casts = [
        'valor_bonus' => 'decimal:2',
    ];

    /**
     * Relacionamentos
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }
}
