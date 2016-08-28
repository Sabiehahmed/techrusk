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
                                    <form class="cmxform form-horizontal tasi-form" id="category_form" method="post" action="{{url('/admin/tag')}}" >
                                    {!! csrf_field() !!}

                                        <div class="form-group">
                                            <label for="tag" class="col-md-3 control-label">Tag</label>
                                            <div class="col-md-8">
                                              <input type="text" class="form-control" name="tag" id="tag"
                                                     value="{{ $tag }}" autofocus>
                                            </div>
                                        </div>
                                                      
                                        @include('admin.tag._form')

                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
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
@stop