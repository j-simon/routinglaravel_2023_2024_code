<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Name darstellen</title>
</head>
<body>
    <ul>
    
    @foreach($users as $user) 
        {{--// Alter < 18 und keine Telefonnummer => grün --}}
        @if( $user['age'] < 18 && empty($user['phone']) ) 
             <li style="color:green">{{$user['name']}}</li>
        @endif
        {{--// Alter ≥18 und keine Telefonnumer => blau --}}
        @if( $user['age'] >= 18 && empty($user['phone']) )  
             <li style="color:blue">{{$user['name']}}</li>
        @endif
        {{--// Alter < 18 und Telefonnummer => rot --}}
       {{--// if( $user['age'] < 18 && !empty($user['phone']) )  echo $user['name']."rot<br>";// Variante 1--}}
        @if( $user['age'] < 18 && isset($user['phone']) )  
            <li style="color:red">{{$user['name']}}</li>
        @endif
        
        {{--// Alter ≥ 18 und Telefonnummer => magenta--}}
        {{--// if( $user['age'] >= 18 && !empty($user['phone']) )  echo $user['name']."magenta<br>";// Variante 1--}}
        @if( $user['age'] >= 18 && isset($user['phone']) )  
            <li style="color:magenta">{{$user['name']}}</li>
        @endif
        text
        @endforeach
    </ul>
    <h1> Liste mit switch-case-break</h1>
    <ul>
        @php $zaehler=0; @endphp
        Im Array sind: {{count($users)}} Namen
        @foreach ($users as $user) 

				@switch($user)

				@case( $user['age'] < 18 && !isset($user['phone']) )
					<li style="color: green">{{$user['name']}}  
						<small>{{$user['email']}}</small>
                        @php $zaehler++; @endphp
					</li> 
				@break

				@case( $user['age'] >= 18 && !isset($user['phone']) ) 
					<li style="color: blue">{{$user['name']}}  
						<small>{{$user['email']}}</small>
                        @php $zaehler++; @endphp
					</li> 
                @break
			
				@case( $user['age'] < 18 && isset($user['phone']) )
					<li style="color: brown">{{$user['name']}}
						<small>{{$user['email']}}</small>
                        @php $zaehler++; @endphp
					</li> 
                @break
				
				@case( $user['age'] >= 18 && isset($user['phone']) )
					<li style="color: magenta">{{$user['name']}} 
						<small>{{$user['email']}}</small>
                        @php $zaehler++; @endphp
					</li> 
                    @break
			
				@endswitch 

			@endforeach 
            Zähler:{{$zaehler}}
    </ul>
</body>
</html>