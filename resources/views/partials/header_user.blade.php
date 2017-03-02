<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid" style="">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('user-home')}}"><img src="{{url('filgram.png')}}  "></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-left" role="search" action="{{route('user-search')}}" method="GET">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" name="query">
                    </div>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                <ul class="nav nav-tabs navbar-right" role="tablist">
                    <li><a href="{{route('user-home')}}">Home  <span class="glyphicon glyphicon-home"></span></a></li>
                    <li><a href="{{route('user-upload_image')}}">Upload  <span class="glyphicon glyphicon-cloud-upload"></span></a></li>  
{{--                     <li><a href="{{route('user-admin')}}"></span>Dashboard  <span class="glyphicon glyphicon-hdd"></a></li>

 --}}                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 12px">
                            <img src="{{url('avatars/'.auth()->user()->avatar)}}" class="img-rounded" style="width: 36px; height:26px;"> {{auth()->user()->full_name}} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href={{ route('user-profile', ['username' => auth()->user()->username]) }}><span class="glyphicon glyphicon-user"></span>  Profile</a></li>
                            <li><a href="{{route('user-profile-edit')}}"><span class="glyphicon glyphicon-cog"></span>  Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('auth_logout')}}"><span class="glyphicon glyphicon-off"></span>  Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
