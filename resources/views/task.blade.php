<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المهام</title>
     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light pt-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
             
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white font-weight-bold">
                    @if(isset($task))
                        
                    @else
                        
                    @endif
                </div>
                <div class="card-body">
                    
                    @if(isset($task))
                        
                        <form action="{{ url('update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $task->id }}">
                            <div class="input-group">
                                <input type="text" name="name" value="{{ $task->name }}" class="form-control" required>
                                <button type="submit" class="btn btn-primary"> </button>
                                <a href="{{ url('tasks') }}" class="btn btn-secondary"> </a>
                            </div>
                        </form>
                    @else
                        
                        <form action="{{ url('create') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" placeholder="أدخل اسم المهمة هنا..." required>
                                <button type="submit" class="btn btn-success"> </button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>

             
            <div class="card shadow-sm">
                <div class="card-header bg-white"> </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-3">#</th>
                                <th>اسم المهمة</th>
                                <th class="text-start px-3">  </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $t)
                                <tr>
                                    <td class="px-3">{{ $t->id }}</td>
                                    <td>{{ $t->name }}</td>
                                    <td class="text-start px-3">
                                        
                                        
                                        <form action="{{ url('edit/' . $t->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-info text-white">تعديل</button>
                                        </form>

                                        
                                        <form action="{{ url('delete/' . $t->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            
                            @if(count($tasks) == 0)
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">   </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>