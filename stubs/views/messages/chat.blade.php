@extends('layouts.messenger')

@section('content')
    @include('messages.components.chatlist', ['users' => $users])          
    @include('messages.components.chatBox', ['messages' => $messages])     
@endsection

@section('js')
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    var id = "{{$con->id}}";
    const pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'ap2'});
      const channel = pusher.subscribe('private-'+id);
  
    
      //Receive messages
    channel.bind('chat', function (data) {
      console.log(pusher , channel);
      $.post("/receive", {
        _token:  '{{csrf_token()}}',
        message: data.message,
        id: id,
      })
       .done(function (res) {
         $(".all-messages > .message").last().after(res);
         scrollChatToBottom();
       });
    });
  
    //Broadcast messages
    $("form").submit(function (event) {
      event.preventDefault();
      $.ajax({
        url:     "/broadcast",
        method:  'POST',
        headers: {
          'X-Socket-Id': pusher.connection.socket_id
        },
        data:    {
          _token:  '{{csrf_token()}}',
          message: $("form #message").val(),
          id: id,
  
        }
      }).done(function (res) {
        $(".all-messages > .message").last().after(res);
        $("form #message").val('');
        scrollChatToBottom();
      });
    });
  
</script>
@endsection