@extends('layouts.admin')

@section('title')

@endsection

@section('content')

           <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tables</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
       <div class="col-md-offset-4 col-md-4">
            @if(Session::has('status'))
                <div class="alert alert-{{Session::get('status')}}" role="alert">
                    <strong>{{Session::get('title')}}</strong><br/>
                    <h5>{{ Session::get('message') }}</h5>
                </div>
            @endif
        </div>
            <!--Field Tables-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Insert User
                        </div>
                      <form class="form-horizontal" style="margin-bottom: 0px;" method="POST" action="{{route('user-tambah')}}">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Username" name="username" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                            </div>
                        </div>
                                              <div class="form-group">
                            <div class="col-sm-12">
                                <input type="email" class="form-control" placeholder="Email" name="email" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Full Name" name="full_name" required="required">
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <div class="col-md-12 ">
                                <input type="submit" class="form-control btn" value="Tambah user" style="background-color: green;color: white;">
                                </form>
                                
                            </div>
                        </div>
                        <!--Akhir Panel Body Tables -->
                    </div>
                </div>
            </div>
            <!--Akhir Field Tables-->
        </div>
        <!--Akhir Page Utama -->
   
@endsection