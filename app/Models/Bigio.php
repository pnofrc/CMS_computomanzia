<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bigio extends Model
{
        protected $fillable = [
    'title',
    'about',
    'items'];

        protected $casts = [
            'items' => 'array',];
}
