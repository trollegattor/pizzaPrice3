<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <title>Document</title>
</head>
<body>
<table class="price-list">
    <thead>
    <tr>
        <th>
            <div class="number">№</div>
        </th>
        <th>
            <div class="pizza">Pizza</div>
        </th>
        <th>Size</th>
        <th>Flavor</th>
        <th>Picture</th>
        <th>Price</th>
    </tr>
    </thead>
    @foreach($products as $item)

        <tr>
            <td>
                <div class="number">{{$loop->iteration}}</div>
            </td>
            <td>
                <div class="pizza"><a href="{{$item->link}}" title="Pizza"> {{$item->name}}</a></div>
            </td>
            <td>
                <pre><select id="sizeSelect{{$item->id}}">
                        @foreach($item->cafe->pizzaProperty->groupBy('size') as $key=>$property)
                            <option>{{$key}}</option>
                        @endforeach
                    </select></pre>
            </td>
            <td>
                <pre><select id="flavorSelect{{$item->id}}">
                        @foreach($item->cafe->pizzaProperty->groupBy('flavor') as $key=>$property)
                            <option>{{$key}}</option>
                        @endforeach
                    </select></pre>
            </td>
            <td class="pictureTable">
                <img class="picture" src="{{$item->picture}}" alt="{{$item->link}}">
            </td>
            <td>
                <p id="price{{$item->id}}"></p>
            </td>

        </tr>
        <script>

            let size{{$item->id}} = document.querySelector("#sizeSelect{{$item->id}}");
            let flavor{{$item->id}} = document.querySelector("#flavorSelect{{$item->id}}")


            size{{$item->id}}.addEventListener('change', function () {
                //alert(this.value);
                document.getElementById("price{{$item->id}}").innerHTML =getPrice(size{{$item->id}}.value,flavor{{$item->id}}.value);
            })

            console.log(flavor{{$item->id}});
            flavor{{$item->id}}.addEventListener('change', function () {
                alert(this.value);
            })



            document.getElementById("price{{$item->id}}").innerHTML =getPrice(size{{$item->id}}.value,flavor{{$item->id}}.value);
function getPrice(size, flavor){
    alert(size)
    @foreach($item->cafe->pizzaProperty as $element)
    if('{{$element->size}}'===size ||'{{$element->flavor}}'===flavor){
      return {{$item->price->where('pizza_property_id',$element->id)->value('price')}};
    }
    @endforeach


}

        </script>
    @endforeach
</table>
</body>
</html>

