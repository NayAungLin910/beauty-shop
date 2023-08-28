<div class="flex place-content-center ">
    <div class="mt-10 px-4 py-2 rounded-2xl bg-pink-600 text-white shadow-lg lg:w-1/3 w-full mx-2">
        <h1 class="text-xl text-center">Create Product</h1>

        <form wire:submit='submit'>

            <!-- Name --->
            <div class="my-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" wire:model='name' class="input-form-pink">
                @error('name')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image -->
            <div class="my-2" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false; progress = 0;"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <label for="image">Image</label>

                <!-- Image Preview -->
                @if ($image && !$errors->first('image'))
                <img loading="lazy" src="{{ $image->temporaryUrl() }}" class="w-[50%] rounded-lg mx-auto"
                    alt="Image Preview">
                @endif

                <input type="file" id="{{ $iteration }}" name="image" wire:model='image' class="input-file-pink">
                @error('image')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror

                <!-- Image Uplaod Progressbar --->
                <hr x-show="uploading" id="image-progress-bar"
                    class="border-4 border-cyan-400 shadow-lg shadow-cyan-400/50 cursor-pointer duration-500 rounded-lg"
                    :style="`width: ${progress}%;`" />
            </div>

            <!-- Price -->
            <div class="my-2">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" wire:model='price' class="input-form-pink">
                @error('price')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tags -->
            <div class="">
                <label for="selects">Tags</label>
                <div class="mt-5 relative">
                    <select id="selects" wire:model='selects' multiple="multiple" class="input-form-pink h-24" name="selects[]">
                        @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Description -->
            <div class="my-2">
                <label for="description">Description</label>
                <textarea class="input-form-pink h-28" name="description" id="description"
                    wire:model='description'></textarea>
                @error('description')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit button -->
            <div class="flex place-content-center mx-2">
                <button type="submit" class="button-white-rounded mx-auto"
                    wire:loading.class="opacity-30 animate-pulse">Create</button>
            </div>

        </form>
    </div>
</div>