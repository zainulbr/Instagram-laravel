@extends('layouts/user')

@section('title')
    Conversations with {{$user->full_name}} | FILGRAM
@endsection

@section('content')

    <div class="panel panel-default">
                    <div class="panel-body">
                        <h3><a href="{{route('user-message')}}" style="text-decoration: none; color: #333333"><span class="glyphicon glyphicon-chevron-left"></span> back</a> | <span class="glyphicon glyphicon-envelope"></span> Messaging with {{$user->full_name}}</h3>
                        <hr>
                        <div class="message"  style="overflow-y: scroll; max-height: 350px;">
                            @if(count($messages) != 0)
                                @foreach($messages as $message)
                                    @if($message['sender_id'] != auth()->user()->id)
                                        <div class="well" style="max-width: 80%">
                                            <div class="message-list">
                                                <div class="account-info">
                                                    <div class="identity-info">
                                                        <div class="row">
                                                            <div class="col-xs-6 text-left">
                                                                <h4 class="name-info" style="margin-bottom: 1%"><a style="color: #333333"> {{ $message['sender_name'] }} :</a></h4>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                {{$message['created_at']}}

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="message-content">{{ $message['message'] }} </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="well" style="max-width: 80%; margin-left: 20%;">
                                            <div class="message-list">
                                                <div class="account-info">
                                                    <div class="identity-info">
                                                        <div class="row">
                                                            <div class="col-xs-6 text-left">
                                                                <h4 class="name-info" style="margin-bottom: 1%">You : </h4>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                {{$message['created_at']}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="message-content">{{ $message['message'] }} </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="alert alert-warning text-center">Message not found. Start Chatting!</div>
                            @endif
                        </div>
                    </div>
                    <!--tempat message-->
                    <div class="panel-footer">
                        <div class="row" style=" margin-top: -8px;">
                            <div class="col-md-12">
                                <div class="comment-form">
                                    <form action="" method="POST" class="form-horizontal">
                                        <div class="form-group" style="margin-bottom: 0px">
                                            <div class="col-md-12 col-xs-12">
                                                <input type="text" class="form-control" id="message" name="message" placeholder="write here ..." >
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection

@section('footer-additional')
    <script type="application/javascript">
        $(document).ready(function () {
            $('.message').scrollTop($('.message')[0].scrollHeight);
        });
        {{--$(document).ready(function () {--}}
            {{--$("#input_comment").keyup(function (event) {--}}
                {{--var message = $("#input_comment").val();--}}

                {{--if (event.keyCode == 13) {--}}
                    {{--if (message != '') {--}}
                        {{--$("#input_comment").val("");--}}
                        {{--$.ajax({--}}
                            {{--url: "{{ route('api-send-message') }}",--}}
                            {{--method: 'post',--}}
                            {{--data: "recipient_id=" + "{{ $recipient_id }}" + "&message=" + message--}}
                        {{--})--}}
                        {{--.done(function (msg) {--}}
                            {{--if (!msg.error) {--}}
                                {{--var ballon = "<div class=\"well\" style=\"max-width: 80%\">";--}}
                                {{--ballon += "<div class=\"message-list\">";--}}
                                {{--ballon += "<div class=\"account-info\">";--}}
                                {{--ballon += "<div class=\"identity-info\">";--}}
                                {{--ballon += "<h4 class=\"name-info\" style=\"margin-bottom: 1%\"><a >" + "{{ auth()->user()->full_name }}" + "</a></h4>";--}}
                                {{--ballon += "<div><div>";--}}
                                {{--ballon += "<div class=\"message-content\">" + message + "</div>";--}}
                                {{--ballon += "<div><div>";--}}

                                {{--$('.message').append(ballon);--}}
                            {{--}--}}
                        {{--});--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    </script>
@endsection