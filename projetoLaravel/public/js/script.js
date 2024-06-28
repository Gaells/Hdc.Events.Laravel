console.log("oi");

// função para o flash message durar 5 sec
document.addEventListener('DOMContentLoaded', function() {
    const msg = document.querySelector('.msg');
    if (msg) {
        setTimeout(() => {
            msg.style.display = 'none';
        }, 5000);
    }
});
