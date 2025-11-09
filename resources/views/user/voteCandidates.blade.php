<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">

            <!-- Title -->
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-10">
                Vote for <span class="text-indigo-600">{{ $election->name }}</span>
            </h1>

            <!-- Candidates Table -->
            <div
                class="bg-white rounded-lg shadow-[0_7px_14px_0_rgba(60,66,87,0.12),0_3px_6px_0_rgba(0,0,0,0.12)] overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">
                                Profile</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">
                                Candidate Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">
                                Party</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-sm font-semibold uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($candidates as $candidate)
                            <tr class="hover:bg-gray-50 transition">
                                <!-- Profile -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $candidate->photo) }}" alt="Candidate Photo"
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

    <!-- OTP Modal -->
<div id="otpModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-80 text-center">
        <h2 class="text-lg font-semibold mb-2 text-gray-800">Enter OTP</h2>
        <p class="text-sm text-gray-500 mb-4">Please enter the OTP sent to your email.</p>

        <input type="text" id="otpInput"
               class="w-full border border-gray-300 rounded-md px-3 py-2 text-center focus:outline-none focus:ring-2 focus:ring-indigo-500"
               placeholder="6-digit OTP">

        <div class="flex justify-center gap-3 mt-5">
            <button id="cancelOtpBtn"
                    class="px-4 py-2 text-sm bg-gray-200 hover:bg-gray-300 rounded-md">Cancel</button>
            <button id="submitOtpBtn"
                    class="px-4 py-2 text-sm bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Submit</button>
        </div>
    </div>
</div>


</x-app-layout>

<!-- OTP Confirmation Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.generate-otp').forEach(button => {
        button.addEventListener('click', async function () {
            const form = this.closest('form');
            const email = "{{ auth()->user()->email }}";

            button.disabled = true;
            button.textContent = "Sending OTP...";
            alert("Please wait, sending OTP to your email...");

            const sendResponse = await fetch("{{ route('otp.send') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ email })
            });

            button.disabled = false;
            button.textContent = "Vote";

            if (!sendResponse.ok) {
                alert("Failed to send OTP. Try again later.");
                return;
            }

            const sendData = await sendResponse.json();
            alert(sendData.message);

            // Show OTP modal
            const otpModal = document.getElementById('otpModal');
            otpModal.classList.remove('hidden');

            // Set up button actions
            document.getElementById('cancelOtpBtn').onclick = () => {
                otpModal.classList.add('hidden');
            };

            document.getElementById('submitOtpBtn').onclick = async () => {
                const userOtp = document.getElementById('otpInput').value.trim();
                if (!userOtp) {
                    alert("Please enter the OTP.");
                    return;
                }

                // Verify OTP
                const verifyResponse = await fetch("{{ route('otp.verify') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ otp: userOtp })
                });

                const verifyData = await verifyResponse.json();

                if (verifyResponse.ok) {
                    alert("OTP verified successfully. Casting your vote...");

                    const tokenInput = document.createElement('input');
                    tokenInput.type = 'hidden';
                    tokenInput.name = 'token';
                    tokenInput.value = verifyData.token;
                    form.appendChild(tokenInput);

                    form.submit();
                } else {
                    alert(verifyData.error || 'OTP verification failed');
                }

                otpModal.classList.add('hidden');
            };
        });
    });
});
</script>
