const userId = window.user.userId;

// Прослушивание сообщений для пользователя
if (userId) {
    window.Echo.private(`user.${userId}`)
        .listen('MessageEvent', (data) => {
            console.log(data.message);
        });
}
