<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
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
    public function payments()
    {
        return $this->hasMany(Payment::class, 'certificate_id');
    }
    public function documents()
    {
        return $this->hasMany(Document::class, 'certificate_id');
    }

}