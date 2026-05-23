  <?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return redirect('tasks');
});

Route::get('tasks', function () {
    $tasks = DB::table('tasks')->get();
    
    return view('task', compact('tasks')); 
});

Route::post('create', function () {
    DB::table('tasks')->insert([
        'name' => request('name') 
    ]);
    
    return redirect()->back();
});

Route::post('delete/{id}', function ($id) {
    DB::table('tasks')->where('id', $id)->delete();
    
    return redirect()->back();
});

Route::post('edit/{id}', function ($id) {
    $task = DB::table('tasks')->where('id', $id)->first();
    $tasks = DB::table('tasks')->get(); 
    
    return view('task', compact('task', 'tasks'));
});

Route::post('update', function () {
    $id = request('id');
    
    DB::table('tasks')->where('id', $id)->update([
        'name' => request('name')
    ]);
    
    return redirect('tasks');
});