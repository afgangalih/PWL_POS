<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level'; // Nama tabel sesuai dengan yang ada di database
    protected $primaryKey = 'level_id'; 
    public $timestamps = false; // Jika tidak menggunakan created_at dan updated_at
}
