@extends('Dashboard::master')

@section('breadcrumb')
    <li><a href="#" title="دسته بندی ها">دسته بندی ها</a></li>
@endsection

@section('content')

    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام دسته بندی</th>
                            <th>نام انگلیسی دسته بندی</th>

                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr role="row" class="">
                                <td><a href="">{{$category->id}}</a></td>
                                <td><a href="">{{$category->title}}</a></td>
                                <td>{{$category->slug}}</td>
                                <td>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item-delete mlg-15" title="حذف" onclick="return confirm('آیا از حذف دسته بندی مطمئن هستید؟')"></button>
                                    </form>
                                    <a href="{{route('categories.edit',$category->id)}}" class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 bg-white">
                <p class="box__title">ایجاد دسته بندی جدید</p>
                <form action="{{route('categories.store')}}" method="post" class="padding-30">
                    @csrf
                    <x-input type="text" name="title" placeholder="نام دسته بندی" class="text"/>
                    <x-input type="text" name="slug" placeholder="نام انگلیسی دسته بندی" class="text"/>
                    <button class="btn btn-webamooz_net">اضافه کردن</button>
                </form>
            </div>
        </div>
    </div>
@endsection
