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

@stop

@section('scripts')

@stop

@section('content')


      <div class="container">

                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pull-left page-title">Update {{$user->name}} Profile</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="#">{{config('blog.title')}}</a></li>
                                <li><a href="#"> Users</a></li>
                                <li class="active">Update Users</li>
                            </ol>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Update User</h3></div>

                                <div class="panel-body">
                                @include('admin.partials.errors')
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                       <form class="cmxform form-horizontal tasi-form" action="{{url('/admin/user',$user->id)}}" method="post">
                                       
                                          {!! csrf_field() !!}
                                          <input type="hidden" name="_method" value="PUT">
    
                                          @include('admin.user._form')


                                         <div class="form-group">
                                          <div class=" col-lg-10">
                                              <button class="btn btn-info waves-effect waves-light" type="submit">Save Changes</button>
                                              <button class="btn btn-danger waves-effect waves-light" type="button" data-toggle="modal" data-target="#modal-delete">Delete</button>
                                          </div>
                                      </div>

                                       </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->
                </div>

   {{-- Confirm Delete --}}
      <div class="modal fade" id="modal-delete" tabIndex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                ×
              </button>
              <h4 class="modal-title">Please Confirm</h4>
            </div>
            <div class="modal-body">
              <p class="lead">
                <i class="fa fa-question-circle fa-lg"></i>  
                Are you sure you want to delete this user?
              </p>
            </div>
            <div class="modal-footer">
              <form method="POST" action="/admin/user/{{ $user->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="DELETE">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">
                  <i class="fa fa-times-circle"></i> Yes
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>


@stop