<div class="flex place-content-center ">
    <div class="mt-10 px-4 py-2 rounded-2xl bg-slate-50 shadow-lg lg:w-1/3 w-full mx-2">

        <!-- Old Profile Image -->
        <img wire:ignore id="profile-image" class="rounded-full w-32 mx-auto shadow-lg"
            src="{{ '/storage' . Auth::user()->image }}" alt="{{ Auth::user()->name }}'s profile image">

        <form wire:submit='submit'>

            <!-- Name --->
            <div class="my-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" wire:model='name' class="input-form-pink">
                @error('name')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email --->
            <div class="my-2">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" wire:model='email' class="input-form-pink">
                @error('email')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image -->
            <div class="my-2" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false; progress = 0;"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <label for="image">New Profile Image</label>

                <!-- Image Preview -->
                @if ($image)
                <img loading="lazy" src="{{ $image->temporaryUrl() }}" class="w-[50%] rounded-lg mx-auto"
                    alt="Image Preview">
                @endif

                <input type="file" id="upload_{{ $iteration }}" name="image" wire:model='image' class="input-file-pink">
                @error('image')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror

                <!-- Image Uplaod Progressbar --->
                <hr x-show="uploading" id="image-progress-bar"
                    class="border-4 border-pink-500 shadow-lg cursor-pointer duration-500 rounded-lg w-[5%]"
                    :style="`width: ${progress}%;`" />
            </div>

            <!-- Change Password -->
            <livewire:auth.change-password />

            <!-- Submit button -->
            <div class="flex place-content-center mx-2">
                <button type="submit" class="button-pink-rounded mx-auto"
                    wire:loading.class="opacity-30 animate-pulse">Save</button>
            </div>

        </form>
    </div>
</div>