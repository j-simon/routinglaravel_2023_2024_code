@extends("meetings.app")

@section("titel","Neues Meetings anlegen")

@section("content")
<h2>Neues Meetings anlegen</h2>

<?php var_dump($errors);?>

<form action="{{ route("meetings.store") }}" method="POST">
    @csrf
    Überschrift<input type="text" name="ueberschrift"><br>
    Datum<input type="text" name="datum"><br>
    <input type="submit" value="speichern">


</form>


@endsection