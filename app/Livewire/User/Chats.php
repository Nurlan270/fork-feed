<?php

namespace App\Livewire\User;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class Chats extends Component
{
    #[Locked]
    public ?User $user;

    #[On('update-chats')]
    public function render()
    {
        return view('livewire.user.chats', [
            'chatsData' => $this->getChatsData(),
        ]);
    }

    protected function getChatsData(): Collection
    {
        return auth()->user()->chats()
            ->with('latestMessage')
            ->withCount(['messages as unread_messages_count' => function ($query) {
                $query->where('is_read', false)
                    ->where('user_id', '!=', auth()->id());
            }])
            ->orderByDesc(
                Message::select('created_at')
                    ->whereColumn('chat_id', 'chats.id')
                    ->latest()
                    ->limit(1),
            )
            ->get()
            ->map(function ($chat) {
                return [
                    'chat' => $chat,
                    'user' => User::where(function ($query) use ($chat) {
                        $query->where('id', $chat->user_a)
                            ->orWhere('id', $chat->user_b);
                    })->firstWhere('id', '!=', auth()->id()),
                ];
            });
    }
}
