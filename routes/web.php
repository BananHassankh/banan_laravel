  <?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;

// يفضل وضع هذا السطر مع باقي المسارات الخاصة بالمشروع
Route::resource('users', UserController::class);

Route::get('/', function () {
    return redirect('users');
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