<x-app-layout>
    <div class="py-3 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-lg font-semibold text-gray-800">
                All Voters
            </h2>
        </div>

        <div class="max-w-7xl mx-auto mt-6">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded">
                    <p class="text-sm text-green-800 text-center font-medium">
                        {{ session('success') }}
                    </p>
                </div>
            @endif
            @if($voters->count() > 0)
                <div class="hidden md:block bg-white rounded shadow-[0_7px_14px_0_rgba(60,66,87,0.12),0_3px_6px_0_rgba(0,0,0,0.12)] overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">S.N</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider"></th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">voter ID</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Name</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">DOB</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Address</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Phone No</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-3 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($voters as $index => $v)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-3 py-3 text-sm text-gray-900">{{ $index + 1 }}</td>

                                    <td class="px-4 py-3 whitespace-nowrap text-center">
                                        @if($v->voterid)
                                            <img src="{{ asset('storage/'.$v->voterid) }}" 
                                                alt="Voter ID" 
                                                class="h-12 w-16 rounded object-cover border border-gray-200">
                                        @else
                                            <span class="text-gray-500 text-sm">No ID</span>
                                        @endif
                                    </td>

                                    <td class="px-3 py-3 text-sm text-gray-900">{{ $v->voteridnumber }}</td>
                                    <td class="px-3 py-3 text-sm text-gray-900">{{ $v->name }}</td>
                                    <td class="px-3 py-3 text-sm text-gray-900">{{ $v->email }}</td>
                                    <td class="px-3 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $v->dob }}</td>
                                    <td class="px-3 py-3 text-sm text-gray-900">{{ $v->address }}</td>
                                    <td class="px-3 py-3 text-sm text-gray-900">{{ $v->phonenumber }}</td>

                                    <td class="px-3 py-3 text-sm">
                                        @if($v->status == 0)
                                            <span class="bg-yellow-600 px-3 py-1 text-white font-bold rounded-lg">Pending</span>
                                        @elseif($v->status == 1)
                                            <span class="bg-green-600 px-1 py-2 text-white font-bold rounded-lg">Approved</span>
                                        @else
                                            <span class="bg-red-600 px-1 py-2 text-white font-bold rounded-lg">Rejected</span>
                                        @endif
                                    </td>

                                    <td class="px-3 py-3 text-right text-sm font-medium">
                                        @if($v->status === 0)
                                            <div class="flex justify-end gap-2">
                                                <form action="{{ route('admin.voters.approve', $v) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded text-xs font-semibold shadow">
                                                        Approve
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.voters.reject', $v) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-semibold shadow">
                                                        Reject
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-gray-500 italic">No action</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-white rounded shadow-[0_7px_14px_0_rgba(60,66,87,0.12),0_3px_6px_0_rgba(0,0,0,0.12)] p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No voters found</h3>
                    <p class="mt-1 text-sm text-gray-500">No voter records are available at this time.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
