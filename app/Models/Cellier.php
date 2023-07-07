<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CellierQuantiteBouteille;

class Cellier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cellierQuantiteBouteille()
    {
        return $this->hasMany(CellierQuantiteBouteille::class);
    }
}
