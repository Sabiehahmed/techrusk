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
                            <h4 class="pull-left page-title">Add User</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="#">{{config('blog.title')}}</a></li>
                                <li><a href="#"> Users</a></li>
                                <li class="active">Create Users</li>
                            </ol>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Create User</h3></div>

                                <div class="panel-body">
                                @include('admin.partials.errors')
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                       <form class="cmxform form-horizontal tasi-form" action="{{url('/admin/user')}}" method="post">
                                       
                                          {!! csrf_field() !!}
    
                                          @include('admin.user._form')



                                           <div class="form-group">
                                              <div class=" col-lg-10">
                                                  <button class="btn btn-info waves-effect waves-light" type="submit">Add User</button>
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




@stop