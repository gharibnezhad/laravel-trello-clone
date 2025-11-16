@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection

@section('content')

    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{route('projects.index')}}">لیست پروژه ها</a>
                <a class="tab__item" href="{{route('projects.create')}}">ایجاد پروژه جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="{{route('searchProject')}}" method="get">
                    @csrf
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی پروژه">
                        <div class="t-header-search-content ">
                            <input type="search" name="search" class="text" placeholder="نام پروژه">
                            <input type="search" name="category" class="text margin-bottom-20" placeholder="دسته بندی">
                            <button type="submit" class="btn btn-webamooz_net">جستجو</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table__box">
            <table class="table">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>نام</th>
                    <th>دسته بندی</th>
                    <th>مالک پروژه</th>
                    <th>تعداد اعضا</th>
                    <th>افزودن عضو</th>
                    <th>مشاهده اعضا</th>
                    <th>فابلیت مشاهده</th>
                    <th>توضیجات</th>
                    <th>دریافت خروجی</th>
                    <th> pdf دریافت خروجی</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($projects as $project)
                    <tr role="row">
                        <td><a href="">{{$project->name}}</a></td>
                        <td>
                            {{$project->category->title ?? '___'}}
                        </td>
                        <td>
                            {{ $project->users()->where('role_id',\Web\RolePermissions\Models\Role::OWNER)->first() ? $project->users->first()->name : '-' }}
                        </td>
                        <td>{{$project->users->count()}}</td>
                        <td><a href="{{route('createMemberToProject',$project->id)}}" class="item-answer mlg-15" title="اضافه کردن اعضا"></a></td>
                        <td><a href="{{route('membersProject',$project->id)}}" class="item-eye mlg-15" title="مشاهده اعضا"></a></td>
                        <td>{{$project->visibility}}</td>
                        <td>{{$project->description}}</td>

                        <td>
                            <div class="btn-group">
                                <button class="btn btn-primary" onclick="showJson({{ $project->id }})">
                                    نمایش JSON
                                </button>
                                <button class="btn btn-success" onclick="downloadJson({{ $project->id }})">
                                    دانلود JSON
                                </button>
                            </div>
                        </td>

                        <form id="jsonExportFormPdf-{{ $project->id }}"
                              action="{{ route('projects.exportPdf', $project->id) }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>

                        <td>
                            <button class="btn all-confirm-btn" onclick="exportPdf({{ $project->id }})">خروجی pdf
                            </button>
                        </td>
                        <td>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="item-delete mlg-15" title="حذف" onclick="return confirm('آیا مطمئن هستید؟')"></button>
                            </form>
                            <a href="{{route('projects.show',$project->id)}}" class="item-eye mlg-15" title="مشاهده پروژه"></a>
                            <a href="{{route('projects.edit',$project->id)}}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection


