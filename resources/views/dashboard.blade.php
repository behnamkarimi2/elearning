<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(auth()->user() && auth()->user()->role === 'admin')
                        <h3 class="text-lg font-bold mb-4">پنل مدیریت</h3>
                        <p>شما به عنوان مدیر وارد شده‌اید.</p>
                        {{-- اینجا می‌تونی لینک‌ها یا امکانات ادمین رو اضافه کنی --}}
                    @else
                        {{ __("You're logged in!") }}
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
