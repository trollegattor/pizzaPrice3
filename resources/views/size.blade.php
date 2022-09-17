<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table width="50" height="50">
<thead>
    <tr>
        <th>Id</th>
        <th>Pizza</th>
        <th>Size</th>
        <th>Flavor</th>
    </tr>
</thead>
    @foreach($products as $item)

        <tr>
            <td>
                {{$item->id}}
            </td>
            <td>
                <a href="{{$item->link}}" title="Pizza"> {{$item->name}}</a>
            </td>
            <td>
                <pre><select id="product{{$item->id}}">
                        @foreach($item->cafe->pizzaProperty->groupBy('size') as $key=>$property)
                            <option>{{$key}}</option>
                        @endforeach
                    </select></pre>
            </td>
            <td>
                <pre><select name="flavor[]" id="product2{{$item->id}}">
                        @foreach($item->cafe->pizzaProperty->groupBy('flavor') as $key=>$property)
                            <option>{{$key}}</option>
                        @endforeach
                    </select></pre>
            </td>


        </tr>



        <script>
            let size = document.querySelector('#product{{$item->id}}')
            document.write(size);
            size.addEventListener('change', function () {
                alert(this.value);
            })
        </script>


    @endforeach
</table>
{{--</select>--}}


</body>
</html>

