<?php

use App\Models\benedettastefani;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/benedettastefani/{eh}', function ($eh) {
    if ($eh == "cattivella"){
        $db = benedettastefani::get();
        // dd($db);
        return $db;
    } else {
        dd();
    }

});
