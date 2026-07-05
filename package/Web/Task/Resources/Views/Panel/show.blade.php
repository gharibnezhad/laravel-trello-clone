@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection

@section('content')

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: "#1d90f5",
                            "50": "#f0f8ff",
                            "100": "#e0f2fe",
                            "200": "#bae6fd",
                            "300": "#7dd3fc",
                            "400": "#38bdf8",
                            "500": "#1d90f5",
                            "600": "#0284c7",
                            "700": "#0369a1",
                            "800": "#075985",
                            "900": "#0c4a6e",
                        },
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e293b",
                        "text-primary-light": "#0f172a",
                        "text-primary-dark": "#f8fafc",
                        "text-secondary-light": "#64748b",
                        "text-secondary-dark": "#94a3b8",
                    },
                    fontFamily: {
                        display: ["Inter"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        lg: "0.75rem",
                        xl: "1rem",
                        full: "9999px",
                    },
                },
            },
        };
    </script>
    <div class="flex flex-col min-h-screen">
        <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-5xl mx-auto">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-text-primary-light dark:text-text-primary-dark">جزئیات تسک</h2>
                </div>

                <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-lg
                p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-medium text-primary-700 dark:text-primary-300">عنوان تسک</h3>
                            <p class="mt-1 text-2xl font-bold text-text-primary-light
                            dark:text-text-primary-dark">{{$task->title}}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-primary-700 dark:text-primary-300">نام برد</h3>
                            <p class="mt-1 text-lg text-text-primary-light
                            dark:text-text-primary-dark">{{$task->taskList->board->name}}</p>

                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-primary-700 dark:text-primary-300">وضعیت تسک</h3>
                            <p class="mt-1 text-lg text-text-primary-light
                            dark:text-text-primary-dark">{{$task->taskList->name}}</p>

                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-primary-700 dark:text-primary-300">توضیجات</h3>
                            <p class="mt-1 text-base text-text-secondary-light
                                dark:text-text-secondary-dark">{{$task->description}}</p>
                        </div>
                    </div>
                </div>


            </div>
        </main>
    </div>
@endsection
