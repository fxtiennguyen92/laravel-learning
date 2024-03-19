<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="/project" method="post">
        @csrf
        <input type="text" name="title" placeholder="project name">
        <input type="text" name="description" placeholder="description">
        <div id="skillsContainer">
            <label>Skill:</label>
            {{-- skills[]  mỗi khi form được gửi đi, dữ liệu từ các trường này sẽ được gửi dưới dạng một mảng của các giá trị skills --}}
            <input type="text" name="skills[]">
        </div>
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
