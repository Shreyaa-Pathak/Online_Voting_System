<div id="addElectionModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4" style="background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(4px);">
    <div class="relative w-full max-w-md">
        <div class="bg-white rounded shadow-[0_7px_14px_0_rgba(60,66,87,0.12),0_3px_6px_0_rgba(0,0,0,0.12)]">
            <div class="px-12 py-0">
                <!-- Modal Header -->
                <div class="flex justify-between items-center pt-6 pb-4">
                    <span class="block text-xl leading-7 text-[#1a1f36]">Add Election</span>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl font-bold leading-none">
                        &times;
                    </button>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('admin.storeelection') }}">
                    @csrf

                    <!-- Election Name Field -->
                    <div class="pb-6">
                        <label for="electionname" class="block text-sm font-semibold mb-2.5">
                            Election Name
                        </label>
                        <input 
                            type="text" 
                            id="electionname"
                            name="electionname" 
                            value="{{ old('electionname') }}"
                            required
                            class="text-base leading-7 py-2 px-4 w-full min-h-[44px] border-0 rounded bg-white outline-indigo-500/50 shadow-[0_0_0_1px_rgba(60,66,87,0.16)] focus:outline-offset-0"
 
                        >
                        @error('electionname')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Date Field -->
                    <div class="pb-6">
                        <label for="date" class="block text-sm font-semibold mb-2.5">
                            End Date
                        </label>
                        <input 
                            type="date" 
                            id="date"
                            name="date" 
                            value="{{ old('date') }}"
                            required
                            min="{{ date('Y-m-d') }}"
                            class="text-base leading-7 py-2 px-4 w-full min-h-[44px] border-0 rounded bg-white outline-indigo-500/50 shadow-[0_0_0_1px_rgba(60,66,87,0.16)] focus:outline-offset-0"
                        >
                        @error('date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-6 pb-6">
                        
                        <input 
                            type="submit" 
                            name="submit" 
                            value="Submit"
                            class="w-full text-base leading-7 py-2 px-4 min-h-[44px] border-0 rounded bg-indigo-600 hover:bg-indigo-700 text-white font-semibold cursor-pointer shadow-md transition-colors duration-200"
                        >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>