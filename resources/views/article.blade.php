@if ($errors->any())
    @foreach($errors->all() as $error)
        <div style="color:red">{{$error}}</div>

@endforeach

@endif

<form action="{{ route('article.store')}}" method="POST">
    @csrf 

    <input name="title" placeholder="Titel des Artikels"  >
    <input name="text" placeholder="Text für den Artikel"  >
    <input name="likes" placeholder="Likes für den Artikel"  >
   
    <input type="submit">

</form>