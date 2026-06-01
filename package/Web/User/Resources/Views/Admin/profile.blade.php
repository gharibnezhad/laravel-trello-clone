@extends('Dashboard::master')

@section('breadcrumb')
    <li><a href="#">پروفایل کاربر</a></li>
@endsection

@section('content')
    <style>



        .bg-blue { background: #3b82f6; }
        .bg-green { background: #10b981; }
        .bg-purple { background: #8b5cf6; }
        .bg-pink { background: #ec4899; }
        .bg-yellow { background: #f59e0b; }
        .bg-indigo { background: #6366f1; }
    </style>

    <div class="profile-container">

        <div class="user-card">
            <a href="{{ route('users.editProfile', $user->id) }}" class="edit-btn" title="ویرایش پروفایل">
                ✏️
            </a>
            <div class="avatar">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <ul class="user-info" style="list-style: none; padding: 0;">
                <li><strong>نام:</strong> {{ $user->name }}</li>
                <li><strong>نام کاربری:</strong> {{ $user->username }}</li>
                <li><strong>ایمیل:</strong> {{ $user->email }}</li>
            </ul>
        </div>


        <h2 style="margin-bottom: 15px; font-size: 20px; font-weight: bold;">پروژه‌های من</h2>

        @if($user->projects->count() > 0)
            <div class="projects-board">
                @php
                    $colors = ['bg-blue','bg-green','bg-purple','bg-pink','bg-yellow','bg-indigo'];
                @endphp

                @foreach($user->projects as $index => $project)
                    <div class="project-card {{ $colors[$index % count($colors)] }}">
                        <h3>{{ $project->title }}</h3>
                        <p>{{ Str::limit($project->description, 80) }}</p>
                        <a href="{{ route('projects.show', $project->id) }}" class="project-link">مشاهده پروژه →</a>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color: #666;">هنوز هیچ پروژه‌ای ایجاد نکردی.</p>
        @endif

        <br>

        <h2 style="margin-bottom: 15px; font-size: 20px; font-weight: bold;">تسک های من</h2>

        @if($user->tasks->count() > 0)
            <div class="projects-board">
                @php
                    $colors = ['bg-blue','bg-green','bg-purple','bg-pink','bg-yellow','bg-indigo'];
                @endphp

                @foreach($user->tasks as $index => $task)
                    <div class="project-card {{ $colors[$index % count($colors)] }}">
                        <h3>{{ $task->title }}</h3>


                        @if($task->taskList?->board)
                            <span style="font-size:12px; opacity:0.85;">
                          📋 {{ $task->taskList->board->name }}
                        </span>
                        @endif

                        <p>{{ Str::limit($task->description, 80) }}</p>
                        <a href="{{ route('tasks.show', $task->id) }}" class="project-link">مشاهده تسک →</a>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color: #666;">هنوز هیچ تسکی ندارید.</p>
        @endif
    </div>
@endsection

