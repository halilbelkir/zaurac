<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Awards extends Model
{
    protected $table = "awards";
    protected $primaryKey = "id";
    protected $guarded = [];
}
