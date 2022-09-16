<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">

    <title>Study page</title>
</head>
<body>
<b> Hello </b>
<br>
<div id="elem">text</div>
<input id=button" type="submit">
<p id="element1">1</p>
<p id="element2">2</p>
<p id="element3">3</p>
<select id="family">
    <option>Oleh</option>
    <option selected value="">Halyna</option>
    <option>Mama</option>
</select>


<div id="parent">
    <form action="">
        <label for="input1"></label><input id="input1" type="text" value="1">
    </form>
    <input id="input2" value="2">
</div>
<script>
    let family=document.querySelector('#family');
    family.addEventListener('change',function (){
        alert(this.value);
    })
   let object={
       name:'John',
       age:54,
       city:'Odessa'
   };
   printMy(object['name']);



    function printMy(data)
    {
       document.write(data);
    }

</script>

</body>
</html>
