<x-app-layout>
    <div class="py-2 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-lg font-semibold text-gray-800">
                All Candidates
            </h2>
            <button onclick="openModal()"
                class="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded transition-colors duration-200 shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Candidate
            </button>
        </div>

        <div class="max-w-7xl mx-auto mt-10">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded">
                    <p class="text-sm text-green-800 text-center font-medium">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            @if($candidates->count() > 0)
                <!-- Desktop Table View -->
                <div
                    class="hidden md:block bg-white rounded shadow-[0_7px_14px_0_rgba(60,66,87,0.12),0_3px_6px_0_rgba(0,0,0,0.12)] overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    S.N
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">

                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Candidate Number
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Candidate Name
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Election
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Party Name
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Address
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($candidates as $index => $candidate)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            @if($candidate->photo)
                                                <img src="{{ asset('storage/' . $candidate->photo) }}" alt="Candidate Photo"
                                                    class="h-12 w-12 rounded-full object-cover">
                                            @else
                                                <span class="text-gray-500 text-sm">No photo</span>
                                            @endif

                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $candidate->candidatenumber }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $candidate->candidatename }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $candidate->election->name }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $candidate->partyname }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $candidate->address }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">

                                        <form action="{{ route('admin.deleteCandidate', $candidate->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this candidate?')"
                                                class="text-red-600 hover:text-red-900">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @else
                <!-- Empty State -->
                <div
                    class="bg-white rounded shadow-[0_7px_14px_0_rgba(60,66,87,0.12),0_3px_6px_0_rgba(0,0,0,0.12)] p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No candidates found</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new candidate.</p>
                    <div class="mt-6">
                        <button onclick="openModal()"
                            class="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded transition-colors duration-200 shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            Add New candidate
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </div>

   <!-- Include Add Candidate Modal -->
    @include('admin.addCandidate-modal')

    <script>
        function openModal() {
            document.getElementById('addCandidateModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('addCandidateModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('addCandidateModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Open modal if there are validation errors
        @if($errors->any())
            openModal();
        @endif
    </script> 
</x-app-layout>