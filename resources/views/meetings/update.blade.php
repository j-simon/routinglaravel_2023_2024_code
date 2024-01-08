@extends("meetings.app")

@section("titel","Meeting geändert")

@section("content")

<h2>Ihr Meeting wurde geändert</h2>
<a href="{{ route("meetings.index") }}">Zurück zur Übersicht!</a>



@endsection