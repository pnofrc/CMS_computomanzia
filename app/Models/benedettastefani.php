<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class benedettastefani extends Model
{
    protected $fillable = [
    'title',
    'items'];

        protected $casts = [
            'items' => 'array',];
        
}
