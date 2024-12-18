// Закрытие фиксированного сообщения
const toast = document.getElementById('notification');
const buttonClose = document.getElementById('btn-close-notification');

buttonClose.addEventListener('click', function () {
    toast.style.display = 'none';
});


