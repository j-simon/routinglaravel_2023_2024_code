@extends("meetings.app")

@section("titel","Meeting ändern")

@section("content")
<h2>Edit Meeting</h2>

<form action="{{ route("meetings.update",[$meeting->id]) }}" method="POST">
    @csrf
    @method("PUT")

    Überschrift<input type="text" name="ueberschrift" value="{{$meeting->ueberschrift}}"><br>
    Datum<input type="text" name="datum" value="{{$meeting->datum}}"><br>
    <input type="submit" value="speichern">


</form>


@endsection