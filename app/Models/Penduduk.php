<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nik',
        'phone_number', 
        'address',
        'gender',
        'tgl_lahir',
        'kabupaten_id'
    ];

    public function kabupaten() {
        
        return $this->belongsTo('App\Models\Kabupaten', 'kabupaten_id');
    }

    public function scopeFilter($query, array $filters) {

        $query->when($filters['request']['provinsi'] ?? false, function ($query, $value) {
            return $query->whereHas('kabupaten', function ($kabupaten) use ($value) {
                 $kabupaten->where('provinsi_id', $value);
            });
        });

        $query->when($filters['request']['kabupaten'] ?? false, function ($query, $value) {
            return $query->whereHas('kabupaten', function ($kabupaten) use ($value) {
                $kabupaten->where('id', $value);
            });
        });

        
    }
}
