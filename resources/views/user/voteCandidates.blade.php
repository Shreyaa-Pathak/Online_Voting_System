<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            
            <!-- Title -->
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-10">
                Vote for <span class="text-indigo-600">{{ $election->name }}</span>
            </h1>

            <!-- Candidates Table -->
            <div class="bg-white rounded-lg shadow-[0_7px_14px_0_rgba(60,66,87,0.12),0_3px_6px_0_rgba(0,0,0,0.12)] overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Profile</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Candidate Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Party</th>
                            <th scope="col" class="px-6 py-3 text-center text-sm font-semibold uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($candidates as $candidate)
                            <tr class="hover:bg-gray-50 transition">
                                <!-- Profile -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $candidate->photo) }}" 
                                         alt="Candidate Photo" 
                                         class="h-14 w-14 rounded-full object-cover border border-gray-200 shadow-sm">
                                </td>

                                <!-- Candidate Name -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $candidate->candidatename }}</div>
                                    <div class="text-xs text-gray-500">#{{ $candidate->candidatenumber ?? 'N/A' }}</div>
                                </td>

                                <!-- Party -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $candidate->partyname }}
                                </td>

                                <!-- Action -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <form action="{{ route('vote.submit') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                                        <input type="hidden" name="election_id" value="{{ $electionId }}">
                                        <input type="hidden" name="otp" class="otp-input">

                                        <button type="button" 
                                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition generate-otp">
                                            Vote
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- OTP Confirmation Script -->
    <script>
        document.querySelectorAll('.generate-otp').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                const otp = Math.floor(100000 + Math.random() * 900000); // 6-digit OTP
                const userInput = prompt("Enter the OTP to confirm your vote:\nOTP: " + otp);

                if (userInput == otp) {
                    form.submit();
                } else {
                    alert("Invalid OTP. Try again.");
                }
            });
        });
    </script>
</x-app-layout>
