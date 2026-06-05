@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4 col-md-8 mx-auto bg-white">
    <h2 class="mb-4 text-success border-bottom pb-2">إنشاء مهمة جديدة</h2>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">عنوان المهمة *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">الوصف</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success px-4">حفظ المهمة</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection
