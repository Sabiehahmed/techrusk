@extends('admin.layout')


@section('topbar')
    @include('admin.partials.topbar')
@stop

@section('sidebar')
    @include('admin.partials.sidebar',['activePost'=>true])
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
            $('#tags_datatable').dataTable();
        });
    </script>
@stop

@section('content')
    
   <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Tags</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">{{config('blog.title')}}</a></li>
                    <li><a href="#"> Post</a></li>
                    <li class="active">Tags</li>
                </ol>
            </div>
        </div>

  

        <div class="row">

                <div class="col-sm-4">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <h3 class="panel-title">Add Tag</h3></div>
                            <div class="panel-body">

                                @include('admin.partials.errors')


                                <div class="form">
                                    <form class="cmxform form-horizontal tasi-form" id="category_form" method="post" action="{{url('/admin/tag',$id)}}" >
                                     {!! csrf_field() !!}

                                      <input type="hidden" name="_method" value="PUT">
                                      <input type="hidden" name="id" value="{{ $id }}">
                                      
                                     <div class="form-group">
                                      <label for="tag" class="col-md-3 control-label">Tag</label>
                                      <div class="col-md-8">
                                        <p class="form-control-static">{{ $tag }}</p>
                                      </div>
                                    </div>
                                                    
                                       @include('admin.tag._form')

                                      <div class="form-group">
                                          <div class=" col-lg-10">
                                              <button class="btn btn-info waves-effect waves-light" type="submit">Save Changes</button>
                                              <button class="btn btn-danger waves-effect waves-light" type="button" data-toggle="modal" data-target="#modal-delete">Delete</button>
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
                                <table id="tags_datatable" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Subtitle</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($tags as $tag)
                                        <tr>
                                            <td>{{$tag->tag}}</td>
                                            <td>{{$tag->subtitle}}</td>

                                            <td class="actions">
                                           
                                           
                                            @include('admin.partials.formAction',[
                                            'subject'=>'Tag',
                                            'viewUrl' => url('/admin/tag',$tag->id),
                                            'editUrl' => url('/admin/tag/'.$tag->id.'/edit'),
                                            'deleteUrl' => url('/admin/tag',$tag->id),
                                            ])
                                            
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="3"> No Tag Found!</td>
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
                Are you sure you want to delete this tag?
              </p>
            </div>
            <div class="modal-footer">
              <form method="POST" action="/admin/tag/{{ $id }}">
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