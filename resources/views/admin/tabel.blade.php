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

            <!--Field Tables-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>

                        <!--Panel Body Tables -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">

                                <!--Isi Tabel-->
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Time Create</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($data as $row) {
                                      ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row->id;?></td>
                                            <td><?php echo $row->username;?></td>
                                            <td><?php echo $row->email;?></td>
                                            <td class="center"><?php echo $row->created_at;?></td>
                                            <td>
                                                  <a href="<?php echo 'edit/'.$row->id;?>"
                                                  <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                                                  </a>
                                            </td>
                                            <td>
                                                 <a href="<?php echo 'delete/'.$row->id;?>"
                                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                  </a>
                                                
                                            </td>
                                        </tr>
                                        <?php } ?>
                                  </tbody>
                                </table>
                                <!--Akhir isi Tabel-->

                                <form action="{{route('user-insert')}}" method="GET" accept-charset="utf-8">
                                    <button type="submit" class="btn btn-success btn-sm">Tambah User</button>
                                </form>
                                
                            </div>
                               <div class="col-md-offset-4 col-md-4">
                                @if(Session::has('status'))
                                    <div class="alert alert-{{Session::get('status')}}" role="alert">
                                        <strong>{{Session::get('title')}}</strong><br/>
                                        <h5>{{ Session::get('status') }}</h5>
                                    </div>
                                @endif
                                    
                            </div>
        </div>
            <!--
                        </div>
                        <!--Akhir Panel Body Tables -->
                    </div>
                </div>
            </div>
            <!--Akhir Field Tables-->
        </div>
        <!--Akhir Page Utama -->
   
@endsection