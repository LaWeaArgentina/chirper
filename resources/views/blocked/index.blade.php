<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($blockedUsers as $blockedUser)
                @if (Auth::user()->id != $blockedUser->pivot->blocked_id)
                    <div class="p-6 flex space-x-2">
                        <div class="flex-1">
                            <div class="mb-8 mx-8 flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $blockedUser->name }}</span>
                                </div>
                                <div>
                                    @if (Auth::user()->blockedUsers()->where('blocked_id', $blockedUser->pivot->blocked_id)->exists())
                                    <form action="{{ route('unblock', $blockedUser->pivot->blocked_id ) }}" method="POST">
                                        @csrf
                                        <button class="w-20 bg-blue-600 text-white rounded-md p-2"
                                            type="submit">Unblock</button>
                                    </form>
                                    @else

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
