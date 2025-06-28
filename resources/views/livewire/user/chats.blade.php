<div class="max-w-7xl mx-auto h-[calc(100vh-70px)]">
    <div class="flex overflow-hidden bg-gray-100 shadow-sm h-full">
        <!-- Sidebar -->
        <div id="drawer-navigation"
             class="fixed md:relative top-[70px] md:top-0 left-0 z-40 w-64 py-4 h-screen overflow-y-auto transition-transform -translate-x-full md:translate-x-0 bg-white border-l border-l-gray-300"
             tabindex="-1"
             aria-labelledby="drawer-navigation-label"
             aria-hidden="true">
            <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase ms-4">
                {{ __('chats.title') }}
            </h5>
            <div class="py-4 overflow-y-auto">
                <ul class="space-y-2 font-medium">
                    @forelse($chatsData as $data)
                        <li>
                            <a href="{{ getLocalizedURL('user.chats.with-user', $data['user']) }}"
                               class="flex items-center p-3 text-gray-900 hover:bg-gray-100 group transition-colors">
                                <img
                                    src="{{ $data['user']['avatar'] }}"
                                    alt="User Avatar"
                                    class="w-10 h-10 rounded-full object-cover flex-shrink-0">
                                <div class="flex-1 ms-3 min-w-0">
                                    <p class="font-medium text-gray-900 truncate">{{ $data['user']['name'] }}</p>
                                    <p class="text-sm text-gray-500 truncate">{{ $data['chat']->latestMessage?->content }}</p>
                                </div>
                                @if($data['chat']->unread_messages_count > 0)
                                    <span
                                        class="inline-flex items-center justify-center w-5 h-5 text-xs font-medium text-white bg-primary-500 rounded-full">
                                        {{ $data['chat']->unread_messages_count }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @empty
                        <p class="text-center text-gray-500 mt-5">
                            {{ __('chats.no_chats') }}
                        </p>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Flowbite Backdrop for mobile -->
        <div id="drawer-backdrop" class="hidden md:hidden fixed inset-0 bg-black/40 z-30"
             data-drawer-backdrop></div>

        <!-- Main Chat Area -->
        <livewire:user.show-chat :$user/>
    </div>
</div>

@pushonce('scripts')
    <script>
        const chatIds = @json($chatsData->pluck('chat.id'));
    </script>
@endpushonce
