@extends("meetings.app")

@section("titel","Datensatz speichert")

@section("content")

<h2>Ihr Meeting wurde gespeichert</h2>
<a href="{{ route("meetings.index") }}">Zurück zur Übersicht!</a>



@endsection