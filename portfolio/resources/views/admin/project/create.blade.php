<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- enctype="multipart/form-data"  dữ liệu được gửi dưới dạng một tập hợp các cặp giá trị khóa-file, thay vì chỉ là text thuần --}}
    <form action="/project" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" placeholder="project name" value="{{ old('title') }}">
        @error('title')
            <div>{{ $message }}</div>
        @enderror
        <input type="text" name="description" placeholder="description">

        <div id="skillsContainer">
            <label>Skill:</label>
            @if (old('skills'))
                {{-- old trả về giá trị cũ của skill  --}}
                {{-- 'skills', [''] đảm bảo rằng ít nhất một ô nhập liệu được hiển thị --}}
                @foreach (old('skills', ['']) as $skill)
                    {{-- skills[]  mỗi khi form được gửi đi, dữ liệu từ các trường này sẽ được gửi dưới dạng một mảng của các giá trị skills --}}
                    <input type="text" name="skills[]" value="{{ $skill }}">
                @endforeach
            @else
                <input type="text" name="skills[]">
            @endif
        </div>

        <input id="image" name="image" type="file">

        <button type="button" onclick="addSkillInput()">Add Another Skill</button><br>
        <button class="btn btn-primary" type="submit">Submit</button>

    </form>
    <script>
        function addSkillInput() {
            const container = document.getElementById('skillsContainer');
            // add cartes html need to ajd
            const inputHTML = '<label>Skill:</label><input type="text" name="skills[]"><br>';
            //show cartes html before the end of this container
            container.insertAdjacentHTML('beforeend', inputHTML);
        }
    </script>
</body>

</html>
