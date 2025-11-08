<x-app-layout>
    <div class="mt-12 py-10 px-4 sm:px-6 lg:px-8 flex justify-center">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Select Election</h2>

            @if(session('success'))
                <div class="mb-4 p-3 text-sm text-green-700 bg-green-100 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-3 text-sm text-red-700 bg-red-100 border border-red-300 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 text-sm text-red-700 bg-red-100 border border-red-300 rounded">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('vote.candidates') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="election_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Election Name
                    </label>
                    <select name="election_id" id="election_id" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                        <option value="">-- Select Election --</option>
                        @foreach($elections as $election)
                            <option value="{{ $election->id }}">{{ $election->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button type="submit"
                        class="w-full py-2.5 px-4 bg-indigo-600 text-white font-semibold text-sm rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                        Continue
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
