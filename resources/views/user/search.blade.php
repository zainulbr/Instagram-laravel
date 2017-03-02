@extends('layouts/user')

@section('title')
    Messages
@endsection

@section('content')
    @if(Session::has('error'))
        <div class="alert alert-{{Session::get('error')}}" role="alert">
            <strong>{{Session::get('title')}}</strong><br/>
            <h5>{!! Session::get('message') !!}</h5>
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info text-center"><h4>{!! "Search Result for <strong>\"".$query."\"</strong>"!!}</h4></div>
                    <hr>
                    <ul class="message-list" >
                        @if(count($result) != 0)
                            @foreach($result as $r)
                                <li style="margin-bottom: 5px;">
                                    <a href="{{route('user-profile', ['username' => $r->username])}}" class="timeline-text message-item">
                                        <div class="row">
                                            <div class="col-xs-6 text-left">
                                                <div class="account-info">
                                                    <img src="{{url('avatars/'.$r->avatar)}}" class="img-thumbnail image-info"/>
                                                    <div class="identity-info">
                                                        <h4 class="name-info">{{$r->full_name}}</h4>
                                                        <h5 class="id-info">{{'@'.$r->username}}</h5>
                                                    </div>
                                                    <div class="message-last">
                                                        {{$r->status_message}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <div class="alert alert-warning text-center">User Not Found!!! Please try again or check your input!!</div>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-additional')

@endsection