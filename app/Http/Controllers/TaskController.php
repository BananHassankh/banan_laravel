<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // 1. عرض قائمة المهام
    public function index()
    {
        $tasks = Task::all(); // جلب البيانات بـ Eloquent
        return view('tasks.index', compact('tasks'));
    }

    // 2. عرض صفحة الإنشاء
    public function create()
    {
        return view('tasks.create');
    }

    // 3. استقبال البيانات وحفظها (الارسال)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Task::create($validatedData); // الحفظ بـ Eloquent

        return redirect()->route('tasks.index')->with('success', 'تم إضافة المهمة بنجاح!');
    }

    // 4. عرض صفحة التعديل
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    // 5. تحديث البيانات (التعديل)
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,completed',
        ]);

        $task = Task::findOrFail($id);
        $task->update($validatedData); // التعديل بـ Eloquent

        return redirect()->route('tasks.index')->with('success', 'تم تعديل المهمة بنجاح!');
    }

    // 6. حذف المهمة (الحذف)
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete(); // الحذف بـ Eloquent

        return redirect()->route('tasks.index')->with('success', 'تم حذف المهمة بنجاح!');
    }
}
