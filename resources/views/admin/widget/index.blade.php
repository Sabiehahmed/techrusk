@extends('admin.layout')


@section('topbar')
    @include('admin.partials.topbar')
@stop

@section('sidebar')
    @include('admin.partials.sidebar',['activeAppearance'=>true])
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
            $('#widgets_datatable').dataTable();
        });
    </script>
@stop

@section('content')
    
   <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Widgets</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">{{config('blog.title')}}</a></li>
                    <li><a href="#"> Appearance</a></li>
                    <li class="active">Widgets</li>
                </ol>
            </div>
        </div>

  

        <div class="row">
      <div class="col-sm-4">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Add Widget</h3></div>
                    <div class="panel-body">

                        @include('admin.partials.errors')


                        <div class="form">
                            <form class="cmxform form-horizontal tasi-form" id="category_form" method="post" action="{{url('/admin/widget')}}" >
                            {!! csrf_field() !!}
                              <div class="form-group">
                                    <label for="title" class="control-label col-lg-4">Title</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="title" name="title" type="text" required="" value="" aria-required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="control-label col-lg-4">Category</label>
                                    <div class="col-lg-8">
                                        <select name="category_id" class="form-control">
                                            <option value="">Select Category</option>
                                            @forelse($categories as $category)
                        
                                            <option value="{{$category->id}}">{{$category->category}}</option>
                                           
                                            @empty

                                            <option value="">No category found</option>
                                            @endforelse
    
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="slug" class="control-label col-lg-4">Type</label>
                                    <div class="col-lg-8">
                                        <select name="type" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="1">Side Bar</option>
                                            <option value="2">General</option>                                    
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn btn-info waves-effect waves-light" type="submit">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- .form -->
                    </div>
                    <!-- panel-body -->
                </div>
                <!-- panel -->
            </div>


            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">List</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="widgets_datatable" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($widgets as $widget)
                                        <tr>
                                            <td>{{$widget->title}}</td>
                                            <td>{{$widget->category->category}}</td>
                                            <td>@if($widget->type == 1) Side Bar @else General @endif</td>

                                            <td class="actions">
                                           
                                           
                                            @include('admin.partials.formAction',[
                                            'subject'=>'Widget',
                                            'viewUrl' => url('/admin/widget',$widget->id),
                                            'editUrl' => url('/admin/widget/'.$widget->id.'/edit'),
                                            'deleteUrl' => url('/admin/widget',$widget->id),
                                            ])
                                            
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="4"> No Widget Found!</td>
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