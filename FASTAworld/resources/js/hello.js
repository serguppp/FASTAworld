const loginBtn = document.getElementById('loginBtn');
const registerBtn = document.getElementById('registerBtn');
const loginSection = document.getElementById('loginSection');
const registerSection = document.getElementById('registerSection');


function showSection(section){
    if (section =="login"){
        loginSection.classList.remove('hidden');
        registerSection.classList.add('hidden');
    }
    else if (section == "register")
    {
        registerSection.classList.remove('hidden');
        loginSection.classList.add('hidden');
    }
}


loginBtn.addEventListener('click', () => {
    showSection('login');
    localStorage.setItem('activeSection', 'login');
});

registerBtn.addEventListener('click', () => {
    showSection('register');
    localStorage.setItem('activeSection', 'register');
});


document.addEventListener('DOMContentLoaded', () => {
    const activeSection = localStorage.getItem('activeSection'); 
    if (activeSection) {
        showSection(activeSection); 
    }
});
