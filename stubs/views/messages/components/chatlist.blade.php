<div class="chatlist">
    <div class="modal-dialog-scrollable">
        <div class="modal-content">
            <div class="chat-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="Open-tab" data-bs-toggle="tab" data-bs-target="#Open" type="button" role="tab" aria-controls="Open" aria-selected="true">All Users</button>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="chat-lists">
                    <div class="tab-content" >
                        <div class="tab-pane fade show active">
                            <div class="chatitem">
                                @foreach($users as $item)
                                <a href="{{route('chat',$item->name)}}" onclick="MoveLocation('{{route('chat',$item->name)}}')" class="d-flex checkurl align-items-center ">
                                    <div class="flex-shrink-0">
                                        @if($item->profile == null)
                                        <img class="img-fluid profile" src="{{asset('account.png')}}" alt="user img">
                                        @else
                                        <img class="img-fluid profile" src="{{asset($item->profile)}}" alt="user img">
                                        @endif
                                        <span class="active"></span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h3>{{$item->name}}</h3>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>