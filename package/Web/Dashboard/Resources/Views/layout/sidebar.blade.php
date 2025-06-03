<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>

    <div class="profile__info border cursor-pointer text-center">
        <div class="avatar__img"><img src="{{asset('panel/img/pro.jpg')}}" class="avatar___img">
            <input type="file" accept="image/*" class="hidden avatar-img__input">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
        <span class="profile__name">کاربر : محمد نیکو</span>
    </div>

    <ul>
        <li class="item-li i-dashboard "><a href="index.html">پیشخوان</a></li>
        @foreach(config('sidebar.items') as $sidebarItems)

        <li class="item-li {{$sidebarItems['icon']}} @if($sidebarItems['url'] == request()->url()) is-active @endif"><a href="{{$sidebarItems['url']}}">{{$sidebarItems['title']}}</a></li>
        @endforeach

        <li class="item-li i-user__inforamtion"><a href="user-information.html">اطلاعات کاربری</a></li>
    </ul>

</div>
