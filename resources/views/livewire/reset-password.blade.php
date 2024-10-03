<div>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-6 rounded-lg shadow-lg">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Reset Password
                </h2>
            </div>

            @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form class="mt-8 space-y-6" wire:submit.prevent="resetPassword">
                <input type="hidden" wire:model="token">
                <div>
                    <label for="email" class="sr-only">Email address</label>
                    <input wire:model.defer="email" id="email" name="email" type="email" autocomplete="email"
                        value="{{$email}}" required class="appearance-none rounded-md relative block w-full px-3 py-2 border 
                        @error('email') border-red-300 text-red-900 @enderror
                        focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm"
                        placeholder="Email address">
                    @error('email')
                    <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="sr-only">New Password</label>
                    <input wire:model.defer="password" id="password" name="password" type="password" required class="appearance-none rounded-md relative block w-full px-3 py-2 border 
                        @error('password') border-red-300 text-red-900 @enderror
                        focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm"
                        placeholder="New Password">
                    @error('password')
                    <p class="mt-2 text-sm text-red-600" id="password-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="sr-only">Confirm New Password</label>
                    <input wire:model.defer="password_confirmation" id="password_confirmation"
                        name="password_confirmation" type="password" required class="appearance-none rounded-md relative block w-full px-3 py-2 border 
                        focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm"
                        placeholder="Confirm New Password">
                </div>

                <div>
                    <button type="submit" wire:navigate
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <span wire:loading.remove>Reset Password</span>
                        <span wire:loading>
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>