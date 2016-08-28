@extends('admin.layout')


@section('topbar')
    @include('admin.partials.topbar')
@stop

@section('sidebar')
    @include('admin.partials.sidebar',['activeSettings'=>true])
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
            $('#banner_datatable').dataTable();
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
                <h4 class="pull-left page-title">Banner Settings</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">{{config('blog.title')}}</a></li>
                    <li><a href="#"> Settings</a></li>
                    <li class="active">Banner Settings</li>
                </ol>
            </div>
        </div>

  

        <div class="row">
      <div class="col-sm-4">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Update Banner</h3></div>
                    <div class="panel-body">

                        @include('admin.partials.errors')


                        <div class="form">
                            <form class="cmxform form-horizontal tasi-form" id="banner_form" method="post" action="{{url('/admin/banner_settings',$banner_->id)}}" >
                            {!! csrf_field() !!}

                                <input type="hidden" name="_method" value="PATCH">
                                <div class="form-group">
                                          <div class="col-md-16">
                                        <div class="dropzone" id="main_image_upload">
                                                   <div class="dz-message" data-dz-message><span>Upload Image</span></div>
                                            </div>
                                          </div>
                                </div>
          
                                <div class="form-group">
                                        <div class="col-md-16">
                                          <input class="form-control" type="text" name="image"  required="required" value="{{$banner_->image}}" placeholder="Category Image Url"> 
                                        </div>
                                </div>
                

                                <div class="form-group">
                                    <label for="title" class="control-label col-lg-4">alt</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="alt" name="alt" type="text"  aria-required="required" value="{{$banner_->alt}}" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn btn-info waves-effect waves-light" type="submit">Update</button>
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
                                <table id="banner_datatable" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Banner Image</th>
                                        <th>Alt</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($banners as $banner)
                                        <tr>
                                            <td><img src="{{$banner->image}}" width="50" height="50"></td>
                                            <td>{{$banner->alt}}</td>

                                            <td class="actions">
                                           
                                           
                                            @include('admin.partials.formAction',[
                                            'subject'=>'Banner',
                                            'viewUrl' => url('/admin/banner_settings',$banner->id),
                                            'editUrl' => url('/admin/banner_settings/'.$banner->id.'/edit'),
                                            'deleteUrl' => url('/admin/banner_settings',$banner->id),
                                            ])
                                            
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="3"> No Banner Found!</td>
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