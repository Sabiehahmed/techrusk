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
    <link href="{{ asset('/backend/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet"
          type="text/css">
@stop

@section('scripts')
    <script src="{{ asset('/backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#posts_datatable').dataTable();
        });
    </script>
@stop

@section('content')
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Post</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">{{config('blog.title')}}</a></li>
                    <li><a href="#"> Post</a></li>
                    <li class="active">All Post</li>
                </ol>
            </div>
        </div>

        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-6">
                <a class="btn btn-info waves-effect waves-light" href="{{url('/admin/post/create')}}">Add New</a>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">List
                                    
                                     <span class="pull-right col-md-5">
                                     
                                    <span> 
                                    <form action="{{url('/admin/post/search')}}" method="GET">

                                        {!! csrf_field() !!}
                                        <div class="input-group">
                                    <span class="input-group-btn">
                                    <button type="submit" class="btn waves-effect waves-light btn-primary">
                                        <i class="fa fa-search"></i></button></span>
                                            <input type="text" id="search" name="search" class="form-control"
                                                   placeholder="Search">
                                        </div>

                    </div>
                    </form>
                    </span>
                                    <span>
                                    
                                     <form action="{{url('/admin/post/filter')}}" method="POST">

                                         {!! csrf_field() !!}
                                         <div class="input-group">
                                    <span class="input-group-btn">
                                    <button type="submit" class="btn waves-effect waves-light btn-primary">
                                        <i class="fa fa-filter"></i></button></span>

                                             <select class="form-control" name="category_id">
                                                 <option value=""></option>
                                                 @forelse($categories as $category)
                                                     <option value="{{$category->id}}">{{$category->category}}</option>
                                                 @empty
                                                     <option value="">No Category Found</option>
                                                 @endforelse
                                             </select>

                                         </div>
                                     </form>
                                    </span>


                    </span>


                    </h3>


                    <div class="panel-body">
                        @include('admin.partials.errors')
                        @include('admin.partials.success')
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Published</th>
                                        <th>Title</th>
                                        <th>Categories</th>
                                        <th>Author</th>
                                        <th data-sortable="false">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse ($posts as $post)
                                        <tr>
                                            <td data-order="{{ $post->published_at->timestamp }}">
                                                {{ $post->published_at->format('j-M-y g:ia') }}
                                            </td>
                                            <td>{{ $post->subtitle }}</td>

                                            @if(isset($post->categories))
                                                <td>@forelse($post->categories as $pcategory)
                                                        ,{{$pcategory->title}}
                                                    @empty
                                                        Not Any!
                                                    @endforelse
                                                </td>
                                            @endif
                                            <td>{{ $post->user->name }}</td>

                                            <td>
                                                <a href="/admin/post/{{ $post->id }}/edit"
                                                   class="btn btn-xs btn-info">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="/post/{{ $post->slug }}"
                                                   class="btn btn-xs btn-warning">
                                                    <i class="fa fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="4"> No Post Found! Mind <a
                                                        href="{{url('/admin/post/create')}}"> adding </a> one ?
                                            </td>
                                        </tr>
                                    @endforelse


                                    </tbody>
                                </table>
                                {!! $posts->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>

    </div>
@stop