<?php

namespace App\Livewire\User;

use App\Events\MessageSeen;
use App\Events\NewMessage;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShowChat extends Component
{
    #[Locked]
    public ?User $user = null;

    #[Validate('required|string|max:10000')]
    public string $message;

    public function mount(): void
    {
        $this->markMessagesAsRead();
    }

    public function render(): View
    {
        return view('livewire.user.show-chat', [
            'chat'     => $this->getChat(),
            'messages' => $this->getChatMessages(),
        ]);
    }

    #[On('update-chats')]
    public function resetUnreadMessagesCount($chatId = null)
    {
        $chat = $this->getChat();

        if ($chat && $chat->id == $chatId) {
            $this->markMessagesAsRead();
        }
    }

    public function sendMessage(): void
    {
        try {
            $this->validate();

            [$userA, $userB] = collect([auth()->id(), $this->user->id])->sort()->values();

            $chat = Chat::firstOrCreate([
                'user_a' => $userA,
                'user_b' => $userB,
            ]);

            $message = auth()->user()->messages()->create([
                'chat_id' => $chat->id,
                'content' => $this->message,
            ]);

            broadcast(new NewMessage($message))->toOthers();

            $this->reset('message');

            $this->dispatch('scroll-to-bottom');
            $this->dispatch('update-chats')->to(Chats::class);
        } catch (ValidationException $e) {
            notyf()->error($e->getMessage());
        }
    }

    protected function markMessagesAsRead(): void
    {
        $unreadMessages = $this->getChat()?->messages()
            ->where('is_read', false)
            ->where('user_id', '!=', auth()->id())
            ->get();

        if (!$unreadMessages) return;

        foreach ($unreadMessages as $message) {
            $message->update(['is_read' => true]);

            broadcast(new MessageSeen($message));
        }

        $this->dispatch('update-chats')->to(Chats::class);
    }

    protected function getChat()
    {
        if (!$this->user) return null;

        [$userA, $userB] = collect([auth()->id(), $this->user->id])->sort()->values();

        return Chat::with('messages')
            ->where(function ($query) use ($userA, $userB) {
                $query->where('user_a', $userA)
                    ->where('user_b', $userB);
            })
            ->first();
    }

    protected function getChatMessages()
    {
        return $this->getChat()->messages ?? [];
    }
}
