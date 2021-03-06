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
    <link href="{{ asset('/backend/assets/plugins/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css">
@stop

@section('scripts')
    <script src="{{ asset('/backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/dropzone/dist/dropzone.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('#category_datatable').dataTable();
        });
    </script>

<script type="text/javascript">
            var baseUrl = "{{ url('/') }}";
            var token = "{{ Session::getToken() }}";
            Dropzone.autoDiscover = false;
             var myDropzone = new Dropzone("div#main_image_upload", { 
                 url: baseUrl+"/admin/upload/file_path",
                 maxFiles: 1,
                 params: {
                    _token: token,
                    'folder': '/',
                  }
             });

             myDropzone.on("success",function(file, response){ 
                $('input[name="image"]').val('');
                $('input[name="image"]').val(response.url);
            }); 

             Dropzone.options.myAwesomeDropzone = {
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 4, // MB
                addRemoveLinks: true
              };
         </script>
@stop

@section('content')
    
   <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Categories</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">{{config('blog.title')}}</a></li>
                    <li><a href="#"> Post</a></li>
                    <li class="active">Categories</li>
                </ol>
            </div>
        </div>

  

        <div class="row">
      <div class="col-sm-4">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Add Category</h3></div>
                    <div class="panel-body">

                        @include('admin.partials.errors')


                        <div class="form">
                            <form class="cmxform form-horizontal tasi-form" id="category_form" method="post" action="{{url('/admin/category')}}" >
                            {!! csrf_field() !!}

                                <div class="form-group">
                                          <div class="col-md-16">
                                        <div class="dropzone" id="main_image_upload">
                                                   <div class="dz-message" data-dz-message><span>Upload Image</span></div>
                                            </div>
                                          </div>
                                </div>
          
                                <div class="form-group">
                                        <div class="col-md-16">
                                          <input class="form-control" type="text" name="image" value="{{ $image }}" placeholder="Category Image Url"> 
                                        </div>
                                </div>
                


                              <div class="form-group">
                                    <label for="category" class="control-label col-lg-4">Category</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="category" name="category" type="text" required="" value="{{ $category }}" aria-required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="control-label col-lg-4">Title</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="title" name="title" type="text" required="" value="{{ $title }}" aria-required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="slug" class="control-label col-lg-4">Slug</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="slug" type="text" name="slug" required="" value="{{ $slug }}"  aria-required="required">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="meta_keywords" class="control-label col-lg-4">Meta Keywords</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="meta_keywords" type="text" name="meta_keywords" value="{{ $meta_keywords}}"  aria-required="required">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="meta_description" class="control-label col-lg-4">Meta Description</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="meta_description" type="text" name="meta_description" value="{{ $meta_description}}"  aria-required="required">
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
                                <table id="category_datatable" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Post Counts</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($categories as $category)
                                        <tr>
                                            <td>{{$category->title}}</td>
                                            <td>{{$category->slug}}</td>
                                            <td>{{$category->posts()->count()}}</td>

                                            <td class="actions">
                                           
                                           
                                            @include('admin.partials.formAction',[
                                            'subject'=>'Category',
                                            'viewUrl' => url('/admin/category',$category->id),
                                            'editUrl' => url('/admin/category/'.$category->id.'/edit'),
                                            'deleteUrl' => url('/admin/category',$category->id),
                                            ])
                                            
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="4"> No Category Found!</td>
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