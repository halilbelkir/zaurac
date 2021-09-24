<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class References extends Model
{
    protected $table = "references";
    protected $primaryKey = "id";
    protected $guarded = [];
}
