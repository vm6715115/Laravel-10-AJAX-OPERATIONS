<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Filter</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body align="center">
    <h1>Products Filter</h1>

    <select name="category" id="category">
        <option value="">Select Category</option>
            @if(count($categories) > 0)
                @foreach ($categories as $category )
                    <option value="{{ $category['id'] }}">{{ $category->name }}</option>
                @endforeach

            @endif
    </select>
    <br><br><br>

    <table border="1" width="50%" align="center">
        <tr>
            <td>S.No</td>
            <td>Name</td>
            <td>Price</td>
            <td>Description</td>
        </tr>
       <tbody id="tbody">
            @if(count($products) > 0)
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product['id'] }}</td>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['price'] }}</td>
                        <td>{{ $product['description'] }}</td>
                    </tr>

                @endforeach
            @endif
       </tbody>
    </table>

    <script>
        $(document).ready(function(){
            $("#category").on('change', function(){
                var category = $(this).val();
                $.ajax({
                    url:"{{ route('filter') }}",
                    type:"GET",
                    data:{'category' : category},

                    success: function(data){
                        var products = data.products;
                        var html = '';
                        if(products.length > 0)
                        {
                            for(let i = 0; i < products.length; i++)
                            {
                                html += '<tr>\
                                    <td>'+(i+1)+'</td>\
                                    <td>'+products[i]['name']+'</td>\
                                    <td>'+products[i]['price']+'</td>\
                                    <td>'+products[i]['description']+'</td>\
                                    </tr>';
                            }
                        }
                        else
                        {
                            html += '<tr>\
                                <td>No products found</td>\
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
