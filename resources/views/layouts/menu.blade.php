<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
</li>

<li class="{{ Request::is('challenges*') ? 'active' : '' }}">
    <a href="{{ route('challenges.index') }}"><i class="fa fa-edit"></i><span>@lang('models/challenges.plural')</span></a>
</li>

<li class="{{ Request::is('flexers*') ? 'active' : '' }}">
    <a href="{{ route('flexers.index') }}"><i class="fa fa-edit"></i><span>@lang('models/flexers.plural')</span></a>
</li>

<li class="{{ Request::is('kingdoms*') ? 'active' : '' }}">
    <a href="{{ route('kingdoms.index') }}"><i class="fa fa-edit"></i><span>@lang('models/kingdoms.plural')</span></a>
</li>

<li class="{{ Request::is('lands*') ? 'active' : '' }}">
    <a href="{{ route('lands.index') }}"><i class="fa fa-edit"></i><span>@lang('models/lands.plural')</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{{ route('users.index') }}"><i class="fa fa-edit"></i><span>@lang('models/users.plural')</span></a>
</li>

<li class="{{ Request::is('weeks*') ? 'active' : '' }}">
    <a href="{{ route('weeks.index') }}"><i class="fa fa-edit"></i><span>@lang('models/weeks.plural')</span></a>
</li>

