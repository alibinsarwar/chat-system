@extends('layouts.messenger')

@section('content')
    @include('messages.components.chatlist', ['users' => $users])  
@endsection