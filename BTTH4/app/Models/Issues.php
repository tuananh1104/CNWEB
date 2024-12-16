<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Issues extends Model
{
    use HasFactory;

    protected $fillable = [
        'computer_id', 'reported_by', 'reported_date', 'description', 'urgency', 'status'
    ];

    public function computer()
    {
        return $this->belongsTo(Computers::class);
    }
}
