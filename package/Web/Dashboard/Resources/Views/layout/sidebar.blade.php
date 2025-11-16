<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>

    <x-user-photo/>

    <ul>
        @php
            $user = auth()->user();
            @endphp
        @foreach(config('sidebar.items') as $sidebarItems)

            @if(\Web\Dashboard\Helper\SidebarItemHelper::canView($user,$sidebarItems))
                <li class="item-li {{$sidebarItems['icon']}} @if($sidebarItems['url'] == request()->url()) is-active @endif">
                    <a href="{{$sidebarItems['url']}}">{{$sidebarItems['title']}}</a></li>
            @endif

        @endforeach

    </ul>

</div>
