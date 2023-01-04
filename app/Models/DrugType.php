<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DrugType extends Model
{
    use HasFactory;

    /**
     * Get the drugType that owns the Type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function drugType(): BelongsTo
    {
        return $this->belongsTo(Drug::class, 'jenis', 'id');
    }
}
