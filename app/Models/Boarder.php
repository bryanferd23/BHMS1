<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boarder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'contact_number',
        'status',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
