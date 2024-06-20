<aside id="sidebar">
    <div class="sidebar">
        <div class="space-y-7">
            <div class="flex items-center justify-between relative">
                <div class="md:text-center sm:text-left space-y-2 pt-10 px-10 w-full">
                    <div class="flex items-center justify-center">
                        <img src="{{asset('admin/images/logo.png')}}" alt="logo" class="h-[30px] w-auto">
                    </div>
                    <div>
                        <h1 class="text-ascent text-lg whitespace-nowrap font-semibold">{{config('app.name')}}</h1>
                    </div>
                    <p class="text-xs text-slate-500">Administrator Panel</p>
                </div>
            </div>
            <div class="absolute top-3 right-0 lg:hidden md:hidden sm:block">
                <button onclick="toggleSidebar()"
                    class="h-[40px] w-[40px] bg-ascent rounded-l-lg border-r-0 flex items-center justify-center transition duration-300 ease-in-out hover:ease-in-out">
                    <i data-feather="chevron-left" class="h-4 w-4 stroke-white stroke-[3px]"></i>
                </button>
            </div>
            <hr class="border-complement">
            <ul class="flex flex-col pb-10">
                
                <li class="sidebar-tab" id="dashboard-tab">
                    <a href="{{route('admin.view.dashboard')}}">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @can(\App\Enums\Permission::VIEW_ACCESS->value)
                <li class="sidebar-tab" id="admin-access-tab">
                    <a href="{{route('admin.view.admin.access.list')}}">
                        <i data-feather="shield"></i>
                        <span>Admin Access</span>
                    </a>
                </li>
                @endcan

                <li class="sidebar-tab" id="registration-tab">
                    <a href="{{route('admin.view.registration.list')}}">
                        <i data-feather="clipboard"></i>
                        <span>Registrations</span>
                    </a>
                </li>

                <li class="sidebar-tab" id="examination-center-tab">
                    <a href="{{route('admin.view.examination.center.list')}}">
                        <i data-feather="map-pin"></i>
                        <span>Examination Centers</span>
                    </a>
                </li>

                <li class="sidebar-tab" id="setting-tab">
                    <a href="{{route('admin.view.setting')}}">
                        <i data-feather="settings"></i>
                        <span>Settings</span>
                    </a>
                </li>
        
            </ul>
        </div>
    </div>
    <div class="sidebar-overlay" onclick="toggleSidebar()">

    </div>
</aside>

