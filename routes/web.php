<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::redirect('/', '/about');

Route::get('/about', function () {
    $departments = [
        '1' => 'Technical',
        '2' => 'Financial',
        '3' => 'Sales'
    ];
    
    return view('about', compact('departments'));
});

Route::post('/about', function (Request $request) {
    
    return redirect('/about')->with('success', 'تم إرسال البيانات بنجاح!');
    
});