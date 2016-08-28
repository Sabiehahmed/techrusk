@extends('admin.layout')

@section('topbar')
    @include('admin.partials.topbar')
@stop

@section('sidebar')
    @include('admin.partials.sidebar',['activeDashboard'=>true])
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
    <!-- moment js  -->
    <script src="{{ asset('/backend/assets/plugins/moment/moment.js')}}"></script>
    <!-- counters  -->
    <script src="{{ asset('/backend/assets/plugins/waypoints/lib/jquery.waypoints.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/counterup/jquery.counterup.min.js')}}"></script>
    <!-- sweet alert  -->
    <script src="{{ asset('/backend/assets/plugins/sweetalert/dist/sweetalert.min.js')}}"></script>
    <!-- flot Chart -->
    <script src="{{ asset('/backend/assets/plugins/flot-chart/jquery.flot.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/flot-chart/jquery.flot.time.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/flot-chart/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/flot-chart/jquery.flot.resize.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/flot-chart/jquery.flot.pie.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/flot-chart/jquery.flot.selection.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/flot-chart/jquery.flot.stack.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/flot-chart/jquery.flot.crosshair.js')}}"></script>
 <!-- dashboard  -->
    <script src="{{ asset('/backend/assets/pages/jquery.dashboard.js')}}"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });
        $('#comments_table').dataTable();
        $('#subscribers_table').dataTable();
    });
    </script>
@stop


@section('content')
<div class="container">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pull-left page-title">Welcome {{Auth::user()->name}}!</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="#">{{config('blog.title')}}</a></li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>

                     @include('admin.partials.errors')
                     @include('admin.partials.success')

                      <!-- stats Widget -->
                    <div class="row">

                        <div class="col-md-6 col-sm-6 col-lg-3">
                            <div class="mini-stat clearfix bx-shadow bg-info"><span class="mini-stat-icon"><i class="md  md-picture-in-picture"></i></span>
                                <div class="mini-stat-info text-right"><span class="counter">{{$post_count}}</span>Total Posts</div>
                                <div class="tiles-progress">
                                    <div class="m-t-20">
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-lg-3">
                            <div class="mini-stat clearfix bg-purple bx-shadow"><span class="mini-stat-icon"><i class="md md-list"></i></span>
                                <div class="mini-stat-info text-right"><span class="counter">{{$category_count}}</span>Total Categories</div>
                                <div class="tiles-progress">
                                    <div class="m-t-20">
                                       </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-6 col-lg-3">
                            <div class="mini-stat clearfix bg-success bx-shadow"><span class="mini-stat-icon"><i class="md md-comment"></i></span>
                                <div class="mini-stat-info text-right"><span class="counter">{{$comments->count()}}</span>Total Comments</div>
                                <div class="tiles-progress">
                                    <div class="m-t-20">
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-3">
                            <div class="mini-stat clearfix bg-primary bx-shadow"><span class="mini-stat-icon"><i class="ion-android-contacts"></i></span>
                                <div class="mini-stat-info text-right"><span class="counter">{{$user_count}}</span>
                                Total Users</div>
                                <div class="tiles-progress">
                                    <div class="m-t-20">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End row-->



   

                    <!-- Comment Row -->
                    <div class="row">
                        <div class="col-md-12">
                             <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Comments List
                                    </h3>
                                </div>
                                <div class="panel-body">
                                 <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">

                                            <table id="comments_table" class="table table-striped table-bordered">
                                            <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>Comment</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                        <th data-sortable="false">Actions</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($comments as $comment)
                                                <tr>
                                                     <td>{{$comment->id}}</td>
                                                     <td>{{$comment->body}}</td>
                                                     <td>{{$comment->user->name}}</td>
                                                     <td>
                                                     @if($comment->is_approved == true)
                                                     <span class="label label-info" data-toggle="tooltip" data-placement="left" title="" data-original-title="This Comment is Approved By Admin">Approved</span>
                                                     @else
                                                     <span class="label label-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="This Comment is Not Approved By Admin Click check button to approve now">Not Approved</span>
                                                     @endif
                                                     </td>
                                                     <td>{{$comment->created_at->toFormattedDateString()}}</td>
                                                     <td>
                                                     @include('admin.partials.approveComment',['subject'=>'Comment','approveUrl'=>url('/admin/approveComment',$comment->id)])
                                                     @include('admin.partials.formAction',[
                                                        'subject'=>'Comment',
                                                        'viewUrl' => url('/post',$comment->commentable->slug).'#comments',
                                                        'deleteUrl' => url('/admin/deleteComment',$comment->id),
                                                        ])
                                                     </td>

                                                </tr>
                                            @empty
                                            <tr> <td colspan="6" class="text-center text-danger"> No Comment Found </td></tr>
                                            @endforelse
                                            </tbody>

                                            </table>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!-- End Comment Row -->

               

                 
                   
</div>
@stop