<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}
    </a>
</li>
@if(backpack_user()->hasRole('admin'))
<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
@endif

<x-backpack::menu-item title="Tasks" icon="la la-question" :link="backpack_url('task')" />
