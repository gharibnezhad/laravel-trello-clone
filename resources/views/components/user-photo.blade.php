<form action="{{route('users.photo')}}" method="post" enctype="multipart/form-data">
    <div class="profile__info border cursor-pointer text-center">
        @csrf
        <div class="avatar__img">
            @if(auth()->user()->image)
                <img src="{{auth()->user()->image->thumb}}" class="avatar___img">
            @elseif(auth()->user()->image == null)
                <img src="{{asset('img/profile.jpg')}}" class="avatar___img">
            @endif

            <input type="file" accept="image/*" class="hidden avatar-img__input"
                   id="userPhotoInput" name="userPhoto"
                   onchange="this.form.submit()">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
        <span class="profile__name">کاربر : {{auth()->user()->name}}</span>
    </div>
</form>

