<x-app-layout>
    <div class="bg-white flex items-center justify-center px-6 py-8">
        <div class="max-w-6xl w-full bg-white rounded-xl overflow-hidden flex flex-col md:flex-row items-center p-8 md:p-12 space-y-8 md:space-y-0 md:space-x-12 animate__animated animate__fadeIn">

            <!-- Left Section -->
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-semibold text-gray-800 mb-4 leading-snug">
                    Welcome to <span class="text-indigo-700 font-bold">Votify Admin Panel</span>
                </h1>
                <p class="text-gray-600 mb-8 text-base md:text-lg leading-relaxed">
                    Access and manage all administrative operations of the Votify system efficiently. 
                    From monitoring user activities to overseeing elections and reports — your control hub is here.
                </p>
                <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4">
                    <a href="{{ route('admin.voters') }}" 
                       class="px-6 py-3 bg-indigo-700 text-white rounded-md shadow-sm hover:bg-indigo-800 transition duration-200 text-center">
                        Manage Voters
                    </a>
                    <a href="{{ route('admin.result') }}" 
                       class="px-6 py-3 border border-indigo-700 text-indigo-700 rounded-md hover:bg-indigo-50 transition duration-200 text-center">
                        View Results
                    </a>
                </div>
            </div>

            <!-- Right Section -->
            <div class="flex-1 flex justify-center">
                <img src="{{ asset('img/adminhome.png') }}" 
                     alt="Administrative Dashboard" 
                     class="w-3/4 md:w-4/5 max-w-sm rounded-lg transition-transform duration-300 hover:scale-105">
            </div>
        </div>
    </div>
</x-app-layout>
