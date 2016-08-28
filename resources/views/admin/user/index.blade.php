@extends('admin.layout')


@section('topbar')
    @include('admin.partials.topbar')
@stop

@section('sidebar')
    @include('admin.partials.sidebar',['activeUsers'=>true])
@stop

@section('footer')
    @include('admin.partials.footer')
@stop

@section('styles')
<link href="{{ asset('/backend/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">
@stop

@section('scripts')
 <script src="{{ asset('/backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#users_datatable').dataTable();
    });
    </script>
@stop

@section('content')


      <div class="container">

                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pull-left page-title">All Users</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="#">Asmani</a></li>
                                <li><a href="#"> {{config('blog.title')}}</a></li>
                                <li class="active">All Users</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-6">
                            <a class="btn btn-info waves-effect waves-light" href="{{url('/admin/user/create')}}">Add New User</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">List</h3></div>





                            



                                <div class="panel-body">
                                 @include('admin.partials.errors')
                                  @include('admin.partials.success')
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <table id="users_datatable" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
                    @forelse($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                     
                    <td>
                    @include('admin.partials.formAction',[
                                            'subject'=>'User',
                                            'viewUrl' => url('/admin/user',$user->id),
                                            'editUrl' => url('/admin/user/'.$user->id.'/edit'),
                                            'deleteUrl' => url('/admin/user',$user->id),
                                            ])

                        </td>
                        </tr>
                         @empty
                            <tr>
                               <td class="text-center" colspan="5"> No Users Found! Mind <a href="{{url('/admin/user/create')}}" > adding </a> one ? </td>
                            </tr>
                        @endforelse


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->
                </div>




@stop