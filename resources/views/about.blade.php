@if(session('success'))
    <div style="color: green; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إرسال البيانات</title>
</head>
<body dir="ltr" style="font-family: sans-serif; padding: 20px;">

    <h2>Task: Form Submission & Arrays</h2>

    <form action="/about" method="POST">
        
        @csrf 

        <div style="margin-bottom: 15px;">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="department">Department:</label><br>
            <select name="department" id="department">
                @foreach ($departments as $key => $department)
                    <option value="{{ $key }}">{{ $department }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" style="padding: 5px 15px;">Send</button>
    </form>

</body>
</html>