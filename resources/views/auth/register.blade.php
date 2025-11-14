<x-guest-layout>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
        @csrf
        <!-- Name & DOB -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="dob" :value="__('DOB')" />
                <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required
                    autofocus autocomplete="dob" />
                <x-input-error :messages="$errors->get('dob')" class="mt-2" />
            </div>
        </div>

        <!-- Gender & Address -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            <div>
                <x-input-label for="gender" :value="__('Gender')" />
                <select id="gender" name="gender" required
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}></option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                    required autofocus autocomplete="address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
        </div>

        <!-- Phone & Email -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            <div>
                <x-input-label for="phonenumber" :value="__('Phone Number')" />
                <x-text-input id="phonenumber" class="block mt-1 w-full" type="number" name="phonenumber"
                    :value="old('phonenumber')" required autofocus autocomplete="phonenumber" />
                <x-input-error :messages="$errors->get('phonenumber')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- Voter ID Number & Voter ID Upload -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            <div>
                <x-input-label for="voteridnumber" :value="__('Voter ID Number')" />
                <x-text-input id="voteridnumber" class="block mt-1 w-full" type="text" name="voteridnumber"
                    :value="old('voteridnumber')" required autofocus autocomplete="voteridnumber" />
                <x-input-error :messages="$errors->get('voteridnumber')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="voterid" :value="__('Voter ID (Upload)')" />
                <x-text-input id="voterid" class="block mt-1 w-full" type="file" name="voterid" :value="old('voterid')"
                    required autofocus autocomplete="voterid" />
                <x-input-error :messages="$errors->get('voterid')" class="mt-2" />
            </div>
        </div>

        <!-- Password & Confirm Password -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>