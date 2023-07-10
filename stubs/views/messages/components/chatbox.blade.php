<div class="chatbox">
    <div class="modal-dialog-scrollable">
        <div class="modal-content">
            <div class="msg-head">
                <div class="row">
                    <div class="col-8">
                        <div class="d-flex align-items-center">
                            <span class="chat-icon"><img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/arroleftt.svg" alt="image title"></span>
                            <div class="flex-shrink-0">
                                @if($receiver->profile == null)
                                <img class="img-fluid profile" src="{{asset('account.png')}}" alt="user img">
                                @else
                                <img class="img-fluid profile" src="{{asset($receiver->profile)}}" alt="user img">
                                @endif
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3>{{$receiver->name}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <ul class="moreoption">
                            <li class="navbar nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Clear Chat</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-body chatBody" style="height: 36rem">
                <div class="msg-body chatMsg" style="height: 36rem">
                    <ul class="all-messages">
                        @foreach($messages as $msg)
                            @if($msg->message_sender == auth()->user()->id)
                                @include('messages.components.send' , ['message' => $msg->message , 'id'=>$msg->message_sender , 'time'=>$msg->created_at])
                            @else
                                @include('messages.components.receive' , ['message' => $msg->message , 'id'=>$msg->message_sender , 'time'=>$msg->created_at])
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="send-box">
                <form>
                    <input type="text" id="message" class="form-control" aria-label="message…" placeholder="Write message…">
                    <button type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
