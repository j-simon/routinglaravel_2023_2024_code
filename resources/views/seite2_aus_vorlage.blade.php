
@extends("layout")

@section('titel',"Seite2-Userliste")

@section('body')
    <h3>Userliste</h3>
    <ul>
    
        @foreach($users as $user) 
            {{--// Alter < 18 und keine Telefonnummer => grün --}}
            @if( $user['age'] < 18 && empty($user['phone']) ) 
                <x-listenzeile farbe="green" username="{{$user['name']}}"/>
            @endif
            {{--// Alter ≥18 und keine Telefonnumer => blau --}}
            @if( $user['age'] >= 18 && empty($user['phone']) )  
                 <x-listenzeile farbe="blue" username="{{$user['name']}}"/>
            @endif
            {{--// Alter < 18 und Telefonnummer => rot --}}
           {{--// if( $user['age'] < 18 && !empty($user['phone']) )  echo $user['name']."rot<br>";// Variante 1--}}
            @if( $user['age'] < 18 && isset($user['phone']) )  
                <x-listenzeile farbe="red" username="{{$user['name']}}"/>
            @endif
            
            {{--// Alter ≥ 18 und Telefonnummer => magenta--}}
            {{--// if( $user['age'] >= 18 && !empty($user['phone']) )  echo $user['name']."magenta<br>";// Variante 1--}}
            @if( $user['age'] >= 18 && isset($user['phone']) )  
                <x-listenzeile farbe="magenta" username="{{$user['name']}}"/>
            @endif
            
            @endforeach
        </ul>
@endsection