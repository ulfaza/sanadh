<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use Notifiable;
    protected $table = 'kelas';
    protected $primaryKey = 'k_id';
    
    protected $fillable = [
        'k_id', 'id', 'nama_kelas'
    ];

    public function subkarakteristik()
    {
        return $this->hasMany(\App\Siswa::class);
    }
}
