@extends('Front::master')

@section('content')
    <div class="mx-auto max-w-7xl px-6 py-16 sm:py-24">
        <div class="flex flex-col gap-16">
            <div class="relative flex min-h-[480px] items-end justify-start overflow-hidden rounded-xl p-8 shadow-lg">
                <div class="absolute inset-0 bg-cover bg-center"
                     style='background-image: url("{{asset('images/hero.png')}}");'></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-black/10"></div>
                <div class="relative z-10 flex max-w-2xl flex-col items-start gap-6 text-white">
                    <h1 class="text-4xl font-black md:text-5xl">TaskFlow helps teams move work forward.</h1>
                    <p class="text-base font-normal text-white/90 md:text-lg">Collaborate, manage projects, and reach
                        new productivity peaks. From high rises to the home office, the way your team works is unique -
                        accomplish it all with TaskFlow.</p>
                    <button
                        class="rounded-lg bg-primary px-5 py-3 text-base font-bold text-white transition-opacity hover:opacity-90">
                        Get started - it's free
                    </button>
                </div>
            </div>
            <div class="flex flex-col items-center gap-8 text-center">
                <div class="flex max-w-3xl flex-col gap-4">
                    <h2 class="text-3xl font-bold text-black dark:text-white md:text-4xl">A productivity hub for you and
                        your team</h2>
                    <p class="text-base text-gray-600 dark:text-gray-300">TaskFlow brings all your tasks, teammates, and
                        tools together</p>
                </div>
                <div class="grid w-full grid-cols-1 gap-8 md:grid-cols-3">
                    <div class="flex flex-col gap-4 text-left">
                        <div class="aspect-video w-full overflow-hidden rounded-lg">
                            <div class="h-full w-full bg-cover bg-center"
                                 style='background-image: url("{{asset('images/card1.png')}}");'></div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h3 class="font-semibold text-black dark:text-white">Manage projects of any size</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">From small projects to large
                                initiatives, TaskFlow adapts to your team's needs. Organize tasks, create workflows, and
                                set deadlines to keep everyone on track.</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 text-left">
                        <div class="aspect-video w-full overflow-hidden rounded-lg">
                            <div class="h-full w-full bg-cover bg-center"
                                 style='background-image: url("{{asset('images/card2.png')}}");'></div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h3 class="font-semibold text-black dark:text-white">Work together from anywhere</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Whether you're in the office or working
                                remotely, TaskFlow keeps your team connected. Collaborate in real-time, share files, and
                                communicate seamlessly.</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 text-left">
                        <div class="aspect-video w-full overflow-hidden rounded-lg">
                            <div class="h-full w-full bg-cover bg-center"
                                 style='background-image: url("{{asset('images/card3.png')}}");'></div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h3 class="font-semibold text-black dark:text-white">Track tasks through any stage</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Visualize your workflow with
                                customizable boards. Track progress, identify bottlenecks, and ensure tasks move
                                smoothly from start to finish.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


