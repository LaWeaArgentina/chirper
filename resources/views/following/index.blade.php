<x-app-layout>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($follows as $follow)
                @if (Auth::user()->id != $follow->id)
                    <div class="p-6 flex space-x-2">
                        <div class="flex-1">

                            <div class="mb-8 mx-8 flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $follow->name }}</span>
                                </div>
                                @if (Auth::user()->id = $follow->pivot->follower_id)
                                    <form action="{{ route('unfollow', $follow->pivot->followed_id) }}" method="POST">
                                        @csrf
                                        <button class="w-20 bg-red-600 text-white rounded-md p-2"
                                            type="submit">Unfollow</button>
                                    </form>
                                @endif

                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>

                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('chirps.edit', $follow)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                            <div class="flex justify-around items-center">
                                <div>
                                    <b>FOLLOWERS:</b>
                                    <p>{{ DB::table('follows')->where('followed_id', $follow->id)->count() }}</p>
                                </div>
                                <div>
                                    <b>FOLLOWING:</b>
                                    <p>{{ DB::table('follows')->where('follower_id', $follow->id)->count() }}</p>
                                </div>
                                <div>
                                    <b>CHIRPS:</b>
                                    <p>{{ DB::table('chirps')->where('user_id', $follow->id)->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
