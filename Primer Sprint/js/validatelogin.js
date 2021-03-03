const mail = document.getElementById('email');
const password = document.getElementById('password');
const form = document.getElementById('form');
const errorElement = document.getElementById('error');

form.addEventListener('submit', (e) => {
    let messager = []
    if(mail.value === '' || mail.value == null){
        messager.push('Falta el nombre')
    }
    if(messager.length)
})