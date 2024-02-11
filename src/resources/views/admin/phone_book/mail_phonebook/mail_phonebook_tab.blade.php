{{-- <div class="col-lg-12">
    <div class="vertical-tab card sticky-item" style="width: 100% !important">
        <div class="flex-column nav-pills gap-2">
            <a class="nav-link {{ request()->routeIs('admin.group.own.email.group') ? 'active' : ' ' }}" href="{{route('admin.group.own.email.group')}}">{{translate('Admin Groups')}}
                 <span><i class="las la-angle-right"></i></span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.group.own.email.user.group') ? 'active' : ' ' }}" href="{{route('admin.group.own.email.user.group')}}">{{translate('User Groups')}}
                 <span><i class="las la-angle-right"></i></span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.group.own.email.contacts') ? 'active' : ' ' }}" href="{{route('admin.group.own.email.contacts')}}">{{translate('Admin Contacts')}}
                <span><i class="las la-angle-right"></i></span>
            </a>
            <a class="nav-link  {{ request()->routeIs('admin.group.own.email.user.contact') ? 'active' : ' ' }}" href="{{route('admin.group.own.email.user.contact')}}">{{translate('User Contacts')}}
                <span><i class="las la-angle-right"></i></span>
            </a>
        </div>
    </div>
</div> --}}


<div class="col-lg-12">
    <div class="row pb-3 g-3">
        <div class="col-md-6 col-sm-12">
            <a class="i-btn {{ request()->routeIs('admin.group.own.email.group') ? 'success--btn' : 'primary--btn' }} btn--md w-100 border-0 rounded text-white p-2" href="{{route('admin.group.own.email.group')}}">
                {{translate('Admin Groups')}}
                <span><i class="las la-angle-right"></i></span>
            </a>
        </div>
        <div class="col-md-6 col-sm-12">
            <a class="i-btn {{ request()->routeIs('admin.group.own.email.contacts') ? 'success--btn' : 'primary--btn' }} btn--md w-100 border-0 rounded text-white p-2 " href="{{route('admin.group.own.email.contacts')}}">
                {{translate('Admin Contacts')}}
                <span><i class="las la-angle-right"></i></span>
            </a>
        </div>
    </div>
</div>
