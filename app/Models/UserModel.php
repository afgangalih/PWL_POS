<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user'; // Nama tabel dalam database
    protected $primaryKey = 'user_id'; // Primary key tabel

    protected $fillable = ['username', 'password', 'nama', 'level_id', 'created_at', 'updated_at'];

    protected $hidden = ['password']; // Jangan tampilkan password saat select
    protected $casts = ['password' => 'hashed']; // Hash password otomatis

    public function level(): BelongsTo {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function getRoleName() : string {
        return $this->level->level_nama;
    }

    public function hasRole($role): bool {
        return $this->level->level_kode == $role;
    }
    
    public function getRole()
    {
        return $this->level->level_kode;
    }
}
