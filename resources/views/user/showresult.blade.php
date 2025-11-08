<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">

            <!-- Title -->
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-8">
                Election Results: <span class="text-indigo-600">{{ $election->name }}</span>
            </h1>

            <!-- Result Summary -->
            <div class="mt-10 text-center">
                @if($winner->votes_count == 0)
                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg py-4 px-6 inline-block">
                        <p class="text-lg font-medium">No votes have been cast yet.</p>
                    </div>
                @else
                    <div class="bg-green-50 border border-green-200 rounded-lg py-6 px-8 shadow">
                        <h2 class="text-xl font-semibold text-green-800">
                            Winner: <span class="text-indigo-700">{{ $winner->candidatename }}</span>
                        </h2>
                        <p class="text-gray-700 mt-2">
                            of <span class="font-medium">{{ $winner->partyname }}</span> Party<br>
                            with <span class="font-semibold text-indigo-700">{{ $winner->votes_count }}</span> votes
                        </p>
                        <div class="flex justify-center mt-4">
                            <img src="{{ asset('storage/' . $winner->photo) }}" alt="Winner Photo"
                                 class="h-24 w-24 rounded-full object-cover border-4 border-indigo-500 shadow-lg">
                        </div>
                    </div>
                @endif
            </div>

            <!-- Table -->
            <div class="mt-12 bg-white rounded-lg shadow-[0_7px_14px_0_rgba(60,66,87,0.12),0_3px_6px_0_rgba(0,0,0,0.12)] overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">
                                Candidate
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">
                                Party
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">
                                Total Votes
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($candidates as $candidate)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $candidate->photo) }}" alt="Photo"
                                         class="h-12 w-12 rounded-full object-cover border border-gray-200 shadow-sm">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $candidate->candidatename }}</p>
                                        <p class="text-xs text-gray-500">#{{ $candidate->candidatenumber ?? 'N/A' }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $candidate->partyname }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                    {{ $candidate->votes_count }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            

        </div>
    </div>
</x-app-layout>
