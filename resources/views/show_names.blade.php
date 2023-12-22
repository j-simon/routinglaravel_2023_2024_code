<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste aller Namen</title>
</head>
<body>
    <h2>Namen mit echo</h2>
   
    <ul>
<?php
    foreach($namen as $name) { 
        echo "<li>".$name."</li>";
     }?>    
    </ul>


    <h2>Namen mit Short echo Tag</h2>
   
    <ul>
    <?php
    foreach($namen as $name) { ?>
        <li><?= $name ?></li>
    <?php } ?>
    </ul>

    <h2>Namen mit Blade Direktiven</h2>
   
    <ul>
    @foreach($namen as $name) 

        @if($loop->iteration <= 5)

            <li>{{ $name }}   {{--$loop->iteration--}}</li>

        @endif

     @endforeach
    </ul>
</body>
</html>