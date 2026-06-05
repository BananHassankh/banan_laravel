@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary mb-0">لوحة إدارة المهام</h2>
        <a href="{{ route('tasks.create') }}" class="btn btn-success fw-bold">+ إضافة مهمة جديدة</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle border text-center">
            <thead class="table-dark">
                <tr>
                    <th># ID</th>
                    <th>عنوان المهمة</th>
                    <th>الوصف</th>
                    <th>الحالة</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td><strong>{{ $task->id }}</strong></td>
                        <td>{{ $task->title }}</td>
                        <td class="text-muted">{{ $task->description ?? 'لا يوجد وصف' }}</td>
                        <td>
                            @if($task->status == 'completed')
                                <span class="badge bg-success p-2">مكتملة</span>
                            @else
                                <span class="badge bg-warning text-dark p-2">قيد الانتظار</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-info text-white me-1">تعديل</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted p-4">لا يوجد مهام مضافة حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
