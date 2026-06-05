@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4 col-md-8 mx-auto bg-white">
    <h2 class="mb-4 text-info border-bottom pb-2">تعديل بيانات المهمة</h2>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label fw-bold">عنوان المهمة</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $task->title) }}">
            @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">الوصف</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $task->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">حالة المهمة</label>
            <select name="status" class="form-select">
                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>مكتملة</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary px-4">تحديث</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection
