<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
    @csrf
    @method('PATCH')

    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    <div class="mt-4">
        <x-input-label for="profile_image" :value="__('Profile Image')" />
        <input id="profile_image" type="file" name="profile_image" accept="image/*" class="mt-1 block w-full" />
        @if ($user->profile_image)
            <img src="{{ Storage::url($user->profile_image) }}" alt="Profile Image" class="mt-2 rounded-full w-20 h-20 object-cover">
        @endif
        <x-input-error :messages="$errors->get('profile_image')" class="mt-2" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                {{ __('Saved.') }}
            </p>
        @endif
    </div>
</form>
