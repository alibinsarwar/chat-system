<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageBroadcast;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Pusher\Pusher;
use Illuminate\Support\Carbon;

class MessageController extends Controller
{
    public function messages(){
        $users = User::where('id','!=',auth()->user()->id)->get();
        return view('messages.list' , get_defined_vars());
    }
    public function chat(){
        $req = request();
        $receiver = User::where('name',$req->slug)->first();
        $users = User::where('id','!=',auth()->user()->id)->get();
        $con = Conversation::where('sender_id',auth()->user()->id)->where('receiver_id',$receiver->id)->first();
        if($con == null){
            $con = Conversation::where('receiver_id',auth()->user()->id)->where('sender_id',$receiver->id)->first();
        }
        if($con == null){
            $con = new Conversation();
            $con->sender_id = auth()->user()->id;
            $con->receiver_id = $receiver->id;
            $con->save();

        }
        $messages = Message::with('conversation')->where('conversation_id',$con->id)->get();
        return view('messages.chat' , get_defined_vars());
    }
    public function broadcast(Request $request)
    {
        $msg = new Message();
        $msg->conversation_id = $request->id;
        $msg->message = $request->message;
        $msg->message_sender = auth()->user()->id;
        $msg->save();

        broadcast(new MessageBroadcast($request->get('message') ,$request->get('id') , $msg->created_at))->toOthers();
        $message = $request->message;
        $time = $msg->created_at;
        return view('messages.components.send', get_defined_vars());
    }

    public function receive(Request $request)
    {
        $time = Carbon::now();
        $message = $request->message;
        return view('messages.components.receive', get_defined_vars());
    }
    public function auth(Request $request)
    {
        // dd($request);
        $userId = 1; // Assuming you have a logged-in user
        $channelName = $request->channel_name;
        $socketId = $request->socket_id;

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ]
        );
        
        $auth = $pusher->socket_auth($channelName, $socketId, $userId);

        return response($auth);
    }
    public function search(Request $req){
        // dd($req);
        $users = User::where('name','like','%'.$req->name.'%')->get();
        return response()->json(['data'=>$users]);
    }
}
