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




<!--<select id="product">-->

<table width="100" height="50">

    <tr>
        <td><pre><strong><a> Id </a>  </strong> </pre></td>
        <td><pre><strong><a> Pizza </a>  </strong> </pre></td>
    </tr>



    @foreach($products as $item)

        <tr>
                <td><pre><strong><a> {{$item->id}}</a>  </strong> </pre></td>
                <td><pre><strong><a href="{{$item->link}}"  title="Pizza"> {{$item->name}}</a>  </strong> </pre></td>
                {{--<td><pre><strong><a> {{$products->pizzaProperty::where('cafe_id', $item->cafe_id)->distinct()->get('size')}}</a>  </strong> </pre></td>--}}

            </tr>

        <!--<option>{{$item->name}}</option>-->

    @endforeach
    </table>
{{--</select>--}}
<script>
    let size = document.querySelector('#product')
    document.write(size.id);
    size.addEventListener('change', function () {
        alert(this.value);
    })
</script>

</body>
</html>

