@extends("meetings.app")

@section("titel","Show Meeting")

@section("content")



<h1>Meeting</h1>

<table class="table">

    <tr>
        <th>Id</th>
        <th>Übreschrift</th>
        <th>Datum</th>
        <th>Anzeigen</th>
        <th>Ändern</th>
        <th>Löschen</th>
    </tr>

   
    <tr>
        <td>{{ $meeting->id }}</td>
        <td>{{ $meeting->ueberschrift }}</td>
        <td>{{ $meeting->datum }}</td>
        <td><a href="meetings/{{$meeting->id}}">anzeigen</a></td>
        <td><a href="meetings/{{$meeting->id}}/edit">ändern</a></td>
        <td>
            <form action="meetings/{{$meeting->id}}" method="POST">
                @csrf
                @method("DELETE")
                <input type="submit" value="löschen">
            </form>
    </tr>

    <a href="{{ route("meetings.index") }}">Zurück zur Übersicht!</a>

</table>
@endsection