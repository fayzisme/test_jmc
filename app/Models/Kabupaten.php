<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'provinsi_id'
    ];

    public function provinsi() {
        
        return $this->belongsTo('App\Models\Provinsi', 'provinsi_id');
    }

    public function penduduks() {
        
        return $this->hasMany('App\Models\Penduduk', 'kabupaten_id');
    }

    public function scopeFilter($query, array $filters) {
        $query->when($filters['request']['provinsi'] ?? false, function ($query, $value) {
            return $query->whereHas('provinsi', function ($provinsi) use ($value) {
                $provinsi->where('id', $value);
            });
        });
    }
}
