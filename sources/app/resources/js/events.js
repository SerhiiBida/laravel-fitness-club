const userId = window.user.userId;

// Прослушивание сообщений для пользователя
if (userId) {
    window.Echo.private(`user.${userId}`)
        .listen('MessageEvent', (data) => {
            const toast = document.getElementById('notification');
            const message = document.getElementById('notification-message');

            message.textContent = data.message;

            toast.style.display = 'block';
        });
}
