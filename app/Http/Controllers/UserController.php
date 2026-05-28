<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // عرض قائمة المستخدمين
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // عرض فورم إضافة مستخدم جديد
    public function create()
    {
        return view('users.create');
    }

    // حفظ المستخدم في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    // عرض فورم تعديل بيانات مستخدم
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // تحديث بيانات المستخدم في قاعدة البيانات
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // تحديث كلمة المرور فقط في حال تم إدخال واحدة جديدة
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'تم تعديل بيانات المستخدم بنجاح');
    }

    // حذف المستخدم من قاعدة البيانات
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}