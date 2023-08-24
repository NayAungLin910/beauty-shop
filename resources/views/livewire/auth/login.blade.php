<div class="flex place-content-center ">
    <div class="mt-10 px-4 py-2 rounded-2xl bg-slate-50 shadow-lg lg:w-1/3 w-full mx-2">
        <h1 class="text-xl text-center">Login</h1>

        <form wire:submit='submit'>

            <!-- Email --->
            <div class="my-2">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" wire:model='email' class="input-form-pink">
                @error('email')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password --->
            <div class="my-2">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" wire:model='password' class="input-form-pink">
                @error('password')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember -->
            <div class="my-2">
                <label for="remember">Remember</label>
                <input type="checkbox" id="remember" class="w-5 my-2 px-2 h-5 block" id="remember" wire:model='remember'>
            </div>

            @error('auth')
            <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
            @enderror

            <!-- Submit button -->
            <div class="flex place-content-center mx-2">
                <button type="submit" class="button-pink-rounded mx-auto"
                    wire:loading.class="opacity-30 animate-pulse">Login</button>
            </div>

        </form>
    </div>
</div>