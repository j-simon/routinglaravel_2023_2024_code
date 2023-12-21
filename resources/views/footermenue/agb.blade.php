<?php 
//dd($daten);
    // dd($vorname);
    // dd($nachname);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agb</title>
</head>

<body>

    <?php
    echo htmlspecialchars($daten['vorname']);
    ?>
    <br>
    
    <?= htmlspecialchars($daten['nachname']) ?>
    <br>
    <?= $daten['nachname'] ?>
    <br>
    {{ $daten['vorname'] }}
    <br>
    {!! $daten['vorname'] !!}
    <br>
    <p style="color:red">Hier befinden sich unseres AGBs.</p>
</body>

</html>