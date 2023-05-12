<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function consultant()
    {
        return $this->belongsTo(Consultant::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function certification()
    {
        return $this->belongsTo(Certification::class, 'certificate_id');
    }
}
