<aside class="main-sidebar">

    <section class="sidebar">


        <div class="card" style="width: 18rem; margin: auto; width: 100%; text-align: center">
            <img src="{{ auth()->user()->avatar_path }}" class="card-img-top  img-thumbnail" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} <a href="#"><i
                            class="fa fa-circle text-success"></i> Online</a></h5>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard') }}"><i
                        class="fa fa-dashboard"></i><span>@lang('site.dashboard')</span></a>
            </li>

            <li>
                @if(app()->getLocale() == 'ar')
                    <a href="{{LaravelLocalization::getLocalizedURL('en')}}"><i class="fa fa-language"></i> الانكليزية</a>
                @else
                <a href="{{LaravelLocalization::getLocalizedURL('ar')}}"><i class="fa fa-language"></i> Arabic</a>
                @endif
            </li>

            @if (auth()->user()->hasRole('super-admin'))
                <li><a href="{{ route('admin.index') }}"><i
                            class="fa fa-users"></i><span>@lang('site.admins')</span></a></li>
            @endif

            @if (auth()->user()->can('qualification read'))
                <li><a href="{{ route('qualification.index') }}"><i
                            class="fa fa-th"></i><span>@lang('site.qualification')</span></a></li>
            @endif

            @if (auth()->user()->can('job_role read'))
                <li><a href="{{ route('jobRole.index') }}"><i
                            class="fa fa-list-alt"></i><span>@lang('site.job_role')</span></a></li>
            @endif
            @if (auth()->user()->can('user read'))
                <li><a href="{{ route('user.index') }}"><i
                            class="fa fa-user "></i><span>@lang('site.employees')</span></a></li>
            @endif

            @if (auth()->user()->can('post read'))
                <li><a href="{{ route('post.index') }}"><i
                            class="fa fa-search"></i><span>@lang('site.posts')</span></a></li>
            @endif

            @if (auth()->user()->can('company read'))
                <li><a href="{{ route('company.index') }}"><i
                            class="fa fa-building"></i><span>@lang('site.companies')</span></a></li>
            @endif

            <li>
                <a href="#" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i>
                    @lang('site.logout')
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>


        </ul>

    </section>

</aside>
