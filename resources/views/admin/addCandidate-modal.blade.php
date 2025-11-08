<div id="addCandidateModal"
     class="hidden fixed inset-0 z-50 flex items-center justify-center p-4"
     style="background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(4px);">

    <div class="relative w-full max-w-2xl">
        <div class="bg-white rounded shadow-[0_7px_14px_0_rgba(60,66,87,0.12),0_3px_6px_0_rgba(0,0,0,0.12)]">
            <div class="px-10 py-0">

                <!-- Modal Header -->
                <div class="flex justify-between items-center pt-6 pb-4">
                    <span class="block text-xl font-semibold text-[#1a1f36]">Add Candidate</span>
                    <button onclick="closeModal()"
                            class="text-gray-400 hover:text-gray-600 text-2xl font-bold leading-none">
                        &times;
                    </button>
                </div>

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('admin.storecandidate') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 py-4">
                        
                        <!-- Election -->
                        <div>
                            <label for="election_id" class="block text-sm font-semibold mb-2.5">
                                Election Name
                            </label>
                            <select id="election_id" name="election_id" required
                                    class="input1 text-base leading-7 py-2 px-4 w-full border-0 rounded bg-white shadow-[0_0_0_1px_rgba(60,66,87,0.16)] focus:outline-indigo-500/50">
                                <option value="">-- Select Election --</option>
                                @foreach($elections as $election)
                                    <option value="{{ $election->id }}">{{ $election->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Candidate Name -->
                        <div>
                            <label for="candidatename" class="block text-sm font-semibold mb-2.5">Candidate Name</label>
                            <input type="text" id="candidatename" name="candidatename"
                                   value="{{ old('candidatename') }}"
                                   required
                                   class="input1 text-base leading-7 py-2 px-4 w-full border-0 rounded bg-white shadow-[0_0_0_1px_rgba(60,66,87,0.16)] focus:outline-indigo-500/50">
                        </div>

                        <!-- Party Name -->
                        <div>
                            <label for="partyname" class="block text-sm font-semibold mb-2.5">Party Name</label>
                            <input type="text" id="partyname" name="partyname"
                                   value="{{ old('partyname') }}"
                                   required
                                   class="input1 text-base leading-7 py-2 px-4 w-full border-0 rounded bg-white shadow-[0_0_0_1px_rgba(60,66,87,0.16)] focus:outline-indigo-500/50">
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-semibold mb-2.5">Address</label>
                            <input type="text" id="address" name="address"
                                   value="{{ old('address') }}"
                                   required
                                   class="input1 text-base leading-7 py-2 px-4 w-full border-0 rounded bg-white shadow-[0_0_0_1px_rgba(60,66,87,0.16)] focus:outline-indigo-500/50">
                        </div>


                        <!-- Photo -->
                        <div>
                            <label for="photo" class="block text-sm font-semibold mb-2.5">Candidate Photo</label>
                            <input type="file" id="photo" name="photo" accept="image/*"
                                   required
                                   class="text-sm text-gray-700 w-full border border-gray-200 rounded py-2 px-3 bg-white focus:outline-indigo-500/50">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6 pb-6">
                        <input type="submit" value="Submit"
                               class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded shadow-md transition-colors duration-200 cursor-pointer">
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="text-center text-green-600 font-medium">
                            {{ session('success') }}
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
</div>
