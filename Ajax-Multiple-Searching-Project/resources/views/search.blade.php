<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body align="center" >
    <h1>Searching</h1>
    <input  type="search" name="search" id="search" placeholder="Search Here......" ><br><br><br>

    <table border="1" align="center" width="50%">
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
        <tbody id="tbody">
            @if (count($users) > 0)
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>No user found.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $("#search").on('keyup', function(){
                var value = $(this).val();
                $.ajax({
                    url:"{{ route('userSearch') }}",
                    type:"GET",
                    data:{'search':value},

                    success: function(data) {
                        var users = data.users;
                        var html = '';
                        if(users.length > 0)
                        {
                            for(let i = 0; i < users.length; i++)
                            {
                                html +='<tr>\
                                    <td>'+users[i]['id']+'</td>\
                                    <td>'+users[i]['name']+'</td>\
                                    <td>'+users[i]['email']+'</td>\
                                    <td>'+users[i]['phone']+'</td>\
                                </tr>';
                            }
                        }
                        else
                        {
                            html +='<tr>\
                                    <td>No users found</td>\
                                </tr>';
                        }


                        $("#tbody").html(html);
                    }
                });
            });
        });
    </script>
</body>
</html>
