 <div class="sidebar-inner slimscrollleft">


                <div class="user-details">
                    <div class="pull-left"><img src="{{ url('/backend/assets/images/users/user_image.png')}}" alt="" class="thumb-md img-circle"></div>
                    <div class="user-info">
                        <div class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{Auth::user()->name}} <span class="caret"></span></a>
                            <ul class="dropdown-menu">

                                <li><a href="{{url('/auth/settings')}}"><i class="md md-settings"></i> Settings</a></li>
                               
                                <li><a href="{{url('/auth/logout')}}"><i class="md md-settings-power"></i> Logout</a></li>

                            </ul>
                        </div>
                        
                    </div>
                </div>
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>
                        <li><a href="{{url('/admin/dashboard')}}" class="waves-effect waves-light @if(isset($activeDashboard)) active @endif  "><i class="md md-home"></i><span>Dashboard</span></a></li>



                        

                        <li class="has_sub"><a href="#" class="waves-effect waves-light @if(isset($activePost)) active @endif"><i class="md md-receipt"></i><span>Post</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{url('/admin/post')}}">All Posts</a></li>
                                <li><a href="{{url('/admin/post/create')}}">Add New</a></li>
                                <li><a href="{{url('/admin/category')}}">Categories</a></li>
                                <li><a href="{{url('/admin/tag')}}">Tags</a></li>
                            </ul>
                        </li>



                         <li><a href="{{url('/admin/upload')}}" class="waves-effect waves-light @if(isset($activeMedia)) active @endif"><i class="md md-file-upload"></i><span>Media</span></a>
                        </li>
                     
                        <li class="has_sub"><a href="#" class="waves-effect waves-light @if(isset($activeAppearance)) active @endif"><i class="md md-picture-in-picture"></i><span>Appearance</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{url('/admin/menu')}}">Menu</a></li>
                                <li><a href="{{url('/admin/widget')}}">Widgets</a></li>
                            </ul>
                        </li>


                        <li class="has_sub"><a href="#" class="waves-effect waves-light @if(isset($activeUsers)) active @endif"><i class="md md-person"></i><span>Users</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{url('/admin/user')}}">All Users</a></li>
                                <li><a href="{{url('/admin/user/create')}}">Add New</a></li>
                              
                            </ul>
                        </li>

                

                        <li class="has_sub"><a href="#" class="waves-effect waves-light @if(isset($activeSettings)) active @endif"><i class="md md-settings"></i><span>Settings</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{url('/admin/settings')}}">General Settings</a></li>
                                <li><a href="{{url('/admin/logo_settings')}}">Logo Settings</a></li>
                                <li><a href="{{url('/admin/banner_settings')}}">Banner Settings</a></li>
                                <li><a href="{{url('/admin/about_settings')}}">About Settings</a></li>
                                <li><a href="{{url('/admin/social_settings')}}">Social Network Icons</a></li>
                                <li><a href="{{url('/admin/social_widgets_settings')}}">Social Widgets</a></li>
                            </ul>
                        </li>


                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="clearfix"></div>
            </div>