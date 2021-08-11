<aside class="main-sidebar">

    <section class="sidebar">


        <div class="card" style="width: 18rem; margin: auto; width: 100%; text-align: center">
            <img src="{{ auth()->user()->avatar_path }}" class="card-img-top  img-thumbnail" alt="...">
            <div class="card-body">
              <h5 class="card-title" style="color: #FFF">{{auth()->user()->first_name . ' ' . auth()->user()->last_name}} <a href="#"><i class="fa fa-circle text-success"></i> Online</a></h5>
              {{-- <a style="color: #FFF" href="{{route('dashboard.profile')}}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> @lang('site.profile')</a> --}}
            </div>
          </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{route('qualification.index')}}"><i class="fa fa-th"></i><span>@lang('site.qualification')</span></a></li>
            <li><a href="{{ route('admin.index') }}"><i class="fa fa-users"></i><span>@lang('site.admins')</span></a></li>
           
            {{-- @if (auth()->user()->hasPermission('categories_read')) --}}
                {{-- <li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-list-alt"></i><span>@lang('site.categories')</span></a></li> --}}
            {{-- @endif --}}
            {{-- @if (auth()->user()->hasPermission('products_read')) --}}
                {{-- <li><a href="{{ route('dashboard.products.index') }}"><i class="fa fa-product-hunt"></i><span>@lang('site.products')</span></a></li> --}}
            {{-- @endif --}}

            {{-- @if (auth()->user()->hasPermission('clients_read')) --}}
            {{-- <li><a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-user-plus"></i><span>@lang('site.clients')</span></a></li> --}}

            {{-- @endif --}}
            {{-- @if (auth()->user()->hasPermission('orders_read')) --}}
                {{-- <li><a href="{{ route('dashboard.orders.index') }}"><i class="fa fa-th"></i><span>@lang('site.orders')</span></a></li> --}}
            {{-- @endif --}}

            {{-- <li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-book"></i><span>@lang('site.categories')</span></a></li>
            {{----}}
            {{----}}
            {{-- <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li> --}}

            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-pie-chart"></i>--}}
            {{--<span>الخرائط</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li>--}}
            {{--<a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}
        </ul>

    </section>

</aside>

