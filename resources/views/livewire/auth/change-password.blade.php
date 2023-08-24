<div x-data="{ open: false }" x-on:success="open = false">
    <button x-show="!open" type="button" x-on:click="open = !open" class="button-pink-rounded p-1 text-sm">Change
        Password</button>

    <div x-show="open" class="my-2 bg-pink-500 text-white px-2 py-1 rounded-lg">

         <!-- New Password --->
        <div class="my-2">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" wire:model='password' class="input-form-pink">
            @error('password')
            <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
            @enderror
        </div>

         <!--Confirm New Password --->
        <div class="my-2">
            <label for="password">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                wire:model='password_confirmation' class="input-form-pink">
            @error('password_confirmation')
            <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
            @enderror
        </div>

        <!--Old Password --->
        <div class="my-2">
            <label for="old_password">Old Password</label>
            <input type="password" name="old_password" id="old_password"
                wire:model='old_password' class="input-form-pink">
            @error('old_password')
            <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-between">
            <button type="button" x-on:click="open = !open" class="button-white-rounded p-1 text-sm">Close</button>
            <button type="button" wire:click="save" class="button-white-rounded p-1 text-sm">Save Password</button>
        </div>

    </div>
</div>