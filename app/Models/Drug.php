<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Drug extends Model
{
    use HasFactory;

    /**
     * Get the type associated with the Drug
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jenisObat(): HasOne
    {
        return $this->hasOne(DrugType::class, 'id', 'jenis');
    }
}
