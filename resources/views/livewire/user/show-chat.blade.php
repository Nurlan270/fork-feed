<div class="flex-1 flex flex-col bg-gray-50 h-full border-l border-r border-t border-b border-gray-300">
    <!-- Chat Header -->
    <div class="bg-white border-b border-gray-200 p-4 flex items-center justify-between flex-shrink-0">
        <div class="flex items-center space-x-3">
            <button
                class="md:hidden text-gray-500 hover:text-primary-600"
                type="button"
                data-drawer-target="drawer-navigation"
                data-drawer-show="drawer-navigation"
                aria-controls="drawer-navigation">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            @if($user)
                <div class="flex items-center space-x-3">
                    <img
                        src="{{ $user->avatar }}"
                        alt="User Avatar"
                        class="w-10 h-10 rounded-full object-cover">
                    <a href="{{ getLocalizedURL('user.tag-profile', $user) }}">
                        <h2 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-600">{{ '@'.$user->username }}</p>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Chat Messages -->
    <div @if($chat)
             data-chat-id="{{ $chat->id }}"
         @endif
         id="chat-container"
         class="flex-1 overflow-y-auto px-4 md:px-6 py-4 space-y-4 relative">
        @if(!$user)
            <div class="absolute inset-0 flex items-center justify-center px-5">
                <div class="bg-white px-8 py-10 rounded-2xl text-gray-500 shadow text-center max-w-lg">
                    <img class="w-72 h-auto mx-auto mb-10"
                         src="{{ asset('media/no-chat-selected.svg') }}" alt="Chats Illustration">
                    <span>
                        {{ __('chats.no_chat_selected') }}
                    </span>
                </div>
            </div>
        @endif

        @foreach($messages as $message)
            @if(auth()->id() === $message->user_id)
                <!-- Sent Message -->
                <div class="flex items-start justify-end" id="message-container" data-message-id="{{ $message->id }}">
                    <div class="flex-1">
                        <div
                            class="bg-primary-500 rounded-lg px-4 py-2 shadow-sm w-fit max-w-xs md:max-w-md ml-auto">
                            <p class="text-white break-words">
                                {{ $message->content }}
                            </p>
                        </div>
                        <div class="flex items-center justify-end gap-x-1 mt-1" id="message-meta">
                            @if($message->is_read)
                                <img src="{{ asset('media/check-read.svg') }}" alt="Read">
                            @endif
                            <p class="text-xs text-gray-500">
                                {{ $message->created_at }}
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <!-- Received Message -->
                <div class="flex items-start">
                    <div class="flex-1">
                        <div class="bg-white rounded-lg px-4 py-2 shadow-sm border w-fit max-w-xs md:max-w-md">
                            <p class="text-gray-900 break-words">
                                {{ $message->content }}
                            </p>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 text-left">
                            {{ $message->created_at }}
                        </p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    @if($user)
        <!-- Message Input -->
        <div class="bg-white border-t border-gray-200 p-4 flex-shrink-0">
            <div class="flex items-center space-x-3">
                <div class="flex-1 relative">
                <textarea
                    wire:model="message"
                    wire:keydown.enter="sendMessage"
                    placeholder="{{ __('chats.message_placeholder') }}"
                    rows="1"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg outline-none resize-none max-h-32"
                    style="min-height: 40px;"></textarea>
                </div>
                <button
                    id="sendBtn"
                    wire:click="sendMessage"
                    title="{{ __('chats.send_button_hint') }}"
                    class="p-2 bg-primary-500 text-white rounded-lg hover:bg-primary-700 transition-colors cursor-pointer">
                    <svg id="spinner"
                         viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none"
                         class="w-5 h-5 animate-spin hidden">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g fill="#ffffff" fill-rule="evenodd" clip-rule="evenodd">
                                <path d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8z"
                                      opacity=".2"></path>
                                <path
                                    d="M7.25.75A.75.75 0 018 0a8 8 0 018 8 .75.75 0 01-1.5 0A6.5 6.5 0 008 1.5a.75.75 0 01-.75-.75z"></path>
                            </g>
                        </g>
                    </svg>
                    <svg id="arrow"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif
</div>

<script>
    // Auto-resize textarea
    const textarea = document.querySelector('textarea');
    if (textarea) {
        textarea.addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 128) + 'px';
        });
    }
</script>
