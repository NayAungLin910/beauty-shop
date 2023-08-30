<div>
    <!-- label -->
    <h1 class="text-center text-2xl my-2">View Accounts</h1>

    <!-- Filter table --->
    <div class="p-2 flex flex-wrap gap-2">
        <!-- Search Name -->
        <div>
            <label for="search">Search</label>
            <input type="text" name="search" id="search" wire:model.live.debounce.200ms='search'
                class="input-form-pink">
        </div>

        <!-- Sort By Time -->
        <div>
            <label for="sort">Sort</label>
            <select class="input-form-pink bg-white p-1" name="sort" wire:model.live.debounce.200ms='sort' id="sort">
                <option value="latest">Latest</option>
                <option value="oldest">Oldest</option>
            </select>
        </div>

        <!-- Sort By Type -->
        <div>
            <label for="type">Sort By Type</label>
            <select class="input-form-pink bg-white p-1" name="sort" wire:model.live.debounce.200ms='type' id="type">
                <option value="all">All</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <!-- Reset --->
        <div class="mt-[1.25rem]">
            <button class="button-pink-rounded" wire:click='resetFilter' wire:target='resetFilter'
                wire:loading.class='opacity-30 animate-pulse'>Reset</button>
        </div>
    </div>

    <!-- Users Table -->
    <div wire:loading.delay.short.remove class="overflow-auto rounded-lg shadow-md m-2 my-3">
        <table class="w-full border-collapse border bg-violet-100 border-violet-100">
            <thead class="border-b text-lg border-violet-100">
                <tr>
                    <th class="table-th"></th>
                    <th class="table-th">Name</th>
                    <th class="table-th">Created At</th>
                    <th class="table-th">Role</th>
                    <th class="table-th"></th>
                </tr>
            </thead>
            <tbody class="border-b border-violet-100">
                @if ($users->count())
                @foreach ($users as $user)
                <tr class="border-b hover:bg-violet-200 border-violet-100" x-on:success.window="edit = false">
                    <td class="table-td">
                        <img id="profile-image" src="{{ asset('storage' . $user->image) }}"
                            class="max-w-[3rem] border rounded-full shadow" loading="lazy"
                            alt="{{ $user->name }}'s profile image" />
                    </td>
                    <td class="table-td">
                        {{ $user->name }}
                    </td>
                    <td class="table-td">
                        {{ $user->created_at }}
                    </td>
                    <td class="table-td">
                        @if ($user->role === '2')
                        <span class="p-2 rounded-lg bg-pink-600 text-white">
                            Admin
                        </span>
                        @else
                        <span class="p-2 rounded-lg bg-slate-200 text-black">
                            Normal
                        </span>
                        @endif
                    </td>
                    <td class="table-td">
                        <div class="flex items-center place-content-around gap-2 ">

                            @if ($user->role === '1')
                            <!-- Change Admin -->
                            <button onclick='openPopupSubmit("Are you sure about changing the user, {{ $user->name }} to an admin?", "", false, "user-change", {{ $user->id }})' type="button" class="button-white-rounded">
                                Change to Admin
                            </button>
                            <!-- Delete --->
                            <button class="button-pink-rounded"
                                onclick='openPopupSubmit("Are you sure about deleteing the user, {{ $user->name }}?", "", true, "user-delete", {{ $user->id }})'>
                                Delete
                            </button>
                            @endif

                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="border-b hover:bg-violet-200 border-violet-100">
                    <td class="table-td text-center" colspan="5">No users found!</td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>

    <!-- loading indicator -->
    <div class="my-2 flex place-content-center">
        <img wire:loading.delay.short class="max-w-[10rem]"
            src="{{ asset('storage/default_images/snail_loading.png!bw700') }}" alt="loading indicator image">
    </div>

    <!-- pagination button -->
    @if ($users->count())
    <div wire:loading.delay.short.remove class="px-2 my-2">
        {{ $users->links() }}
    </div>
    @endif
</div>
