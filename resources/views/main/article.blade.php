@extends('layout') 
@section('content')

<table class="table">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Name</th>
      <th scope="col">ShortDesc</th>
      <th scope="col">Desc</th>
      <th scope="col">Preview image</th>
    </tr>
  </thead>
  <tbody>
    @foreach($articles as $article)
    <tr>
      <th scope="row">{{$article->date}}</th>
      <td>{{$article->name}}</td>
      <td>{{$article->shortDesc}}</td>
      <td>{{$article->desc}}</td>
      <td><a href="/full_image/{{$article->full_image}}"> 
            <img src="{{URL::asset($article->preview_image)}}" alt=""> 
          </a> 
      </td>
    </tr>
    @endforeach
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
  </tbody>
</table>

<!-- Pusher JS для уведомлений -->
<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
<script>
    // Включаем логирование для отладки
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        encrypted: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        // Показываем alert при приходе события
        alert('Новое событие: ' + JSON.stringify(data));
    });
</script>

@endsection
