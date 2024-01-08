@extends("meetings.app")

@section("titel","Meeting gelöscht")

@section("content")

<h2>Ihr Meeting wurde gelöscht</h2>
<a href="{{ route("meetings.index") }}">Zurück zur Übersicht!</a>



@endsection