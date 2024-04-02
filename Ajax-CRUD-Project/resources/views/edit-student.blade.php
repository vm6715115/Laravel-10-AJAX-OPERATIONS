<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Update</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <img src="{{asset($student[0]->image)}}" alt="{{$student[0]->image}}">
    <form id="update-form">
        @csrf
        <input type="text" name="name" value="{{$student[0]->name}}" placeholder="Enter Name" required>
        <br><br>
        <input type="email" name="email" value="{{$student[0]->email}}" placeholder="Enter Email" required>
        <br><br>
        <input type="file" name="image">
        <input type="hidden" name="id" value="{{$student[0]->id}}">
        <br><br>
        <input type="submit" value="Update Student" id="btnSubmit">
    </form>
    <span id="output"></span>

    <script>
        $(document).ready(function()
        {
            $('#update-form').submit(function(event)
            {
                event.preventDefault();

                var form = $("#update-form")[0];
                var data = new FormData(form);

                $.ajax(
                {
                    type: "POST",
                    url:"{{route('updateStudent')}}",
                    data:data,
                    processData:false,
                    contentType:false,
                    success:function(data) 
                    {
                        $("#output").text(data.result);
                        window.open("/get-students","_self");
                    },

                    error:function(err)
                    {
                        $("#output").text(err.responseText);
                        
                    }

                });
            });
        });
    </script>
</body>
</html>