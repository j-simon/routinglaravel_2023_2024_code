<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daten ausgeben</title>
</head>
<body>
    <h2>Liste aller Benutzer mit klassischen php-Befehlen</h2>
    <table border="1">

        <?php foreach($daten as $data) { ?>
        <tr>
        <td>{{ $data['id'] }}</td><td>{{$data['vorname'] }}</td><td>{{ $data['nachname'] }}</td>
        </tr>
    <?php } ?>

    </table>
<!-- hier wird etwa erklärt HTML Komentar unerwünscht-->

    <?php // hier wird etwas erklärt ?>
    {{-- hier wird etwas erklärt --}}
<h2>Liste aller Benutzer mit Blade Direktiven</h2>
<table border="1">

@foreach($daten as $data)
<tr>
   <td>{{ $data['id'] }}</td><td>{{$data['vorname'] }}</td><td>{{ $data['nachname'] }}</td>
</tr>
@endforeach


</table>

</body>
</html>