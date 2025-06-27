const sendBtn = document.querySelector('#sendBtn');
const spinner = sendBtn?.querySelector('#spinner');
const arrow = sendBtn?.querySelector('#arrow');

if (typeof chatIds !== 'undefined' && chatIds) {
    chatIds.forEach((id) => {
        Echo.join(`chat.${id}`)
            .listen('NewMessage', (e) => {
                Livewire.dispatch('update-chats', {chatId: id});
                appendMessage(e.message);
            })
            .listen('MessageSeen', (e) => {
                markMessageAsSeen(e.id);
            })
            .error((error) => {
                console.error(error);
            });
    });
}

// Utility function to escape HTML to prevent XSS
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Utility function to scroll to bottom of chat
function scrollToBottom() {
    const chatContainer = document.querySelector('#chat-container');
    if (chatContainer) {
        setTimeout(() => {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }, 10);
    }
}

function appendMessage(message) {
    const chatContainer = document.querySelector(`[data-chat-id='${message.chat_id}']`);
    if (!chatContainer) return;

    const time = message.created_at;

    const messageDiv = document.createElement('div');
    messageDiv.style.opacity = '0';
    messageDiv.style.transform = 'translateY(20px)';
    messageDiv.style.transition = 'all 0.3s ease';
    messageDiv.innerHTML = `
        <div class="flex items-start">
            <div class="flex-1">
                <div class="bg-white rounded-lg px-4 py-2 shadow-sm border w-fit max-w-xs md:max-w-md">
                    <p class="text-gray-900 break-words">
                        ${escapeHtml(message.content)}
                    </p>
                </div>
                <p class="text-xs text-gray-500 mt-1">
                    ${time}
                </p>
            </div>
        </div>
        `;

    chatContainer.appendChild(messageDiv);

    // Trigger animation
    setTimeout(() => {
        messageDiv.style.opacity = '1';
        messageDiv.style.transform = 'translateY(0)';
    }, 100);

    scrollToBottom();
}

function markMessageAsSeen(messageId) {
    const container = document.querySelector(`[data-message-id='${messageId}']`);
    if (!container) return;

    const metaDiv = container.querySelector('#message-meta');
    if (!metaDiv) return;

    // Check if image already exists to prevent duplicates
    if (metaDiv.querySelector('img')) return;

    const img = document.createElement('img');
    img.src = '/media/check-read.svg';
    img.alt = 'Read';

    metaDiv.prepend(img);
}

document.addEventListener('DOMContentLoaded', () => {
    scrollToBottom();
});

Livewire.on('scroll-to-bottom', () => {
    scrollToBottom()
});
