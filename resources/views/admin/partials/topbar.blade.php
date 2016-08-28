<!-- LOGO -->
<div class="topbar-left">
    <div class="text-center"><a href="#" class="logo"><i class="md  md-dashboard"></i> <span><small>{{config('blog.title')}}</small></span></a>
    </div>
</div>
<div class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="">
            <div class="pull-left">
                <button class="button-menu-mobile open-left"><i class="fa fa-bars"></i></button>
                <span class="clearfix"></span></div>


            <ul class="nav navbar-nav navbar-right pull-right">

                <li class="hidden-xs"><a href="#" id="btn-fullscreen" class="waves-effect"><i
                                class="md md-crop-free"></i></a></li>


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img
                                src="{{ url('/backend/assets/images/users/user_image.png')}}" alt="user-img"
                                class="img-circle"></a>
                    <ul class="dropdown-menu">

                        <li><a href="{{url('/')}}"><i class="md md-face-unlock"></i> Go To Site</a></li>

                        <li><a href="{{url('/admin/settings')}}"><i class="md md-settings"></i> Settings</a></li>
                        <form action="{{url('/logout')}}" method="POST">
                            {!! csrf_field() !!}
                            <li>
                                <button type="submit" style="    width: 100%;
    text-align: left;
    background: transparent;
    border: none;
    padding-left: 18px;
    font-size: 16px;"><i class="md md-settings-power"></i> Logout
                                </button>
                            </li>
                        </form>

                    </ul>
                </li>


            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>