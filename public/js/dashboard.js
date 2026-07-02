function smoothScroll(id) {
        const target = document.getElementById(id);
        if (!target) return;

        const offset = 64; // tinggi navbar
        const top =
            target.getBoundingClientRect().top + window.pageYOffset - offset;

        window.scrollTo({
            top,
            behavior: 'smooth'
        });
    }

    // smoothScroll(document.getElementById('materi'));

    document.getElementById('burger-toggle').addEventListener('click', function() {
        const sideBar = document.getElementById('sideBar');
        const konten = document.getElementById('konten');
        const footer = document.getElementById('footer');
        if (sideBar.style.transform === 'translateX(-100%)') {
        sideBar.style.transform = 'translateX(0)';
        sideBar.classList.toggle('-translate-x-full');
        // konten.style.marginLeft = '224px';
        konten.classList.add('md:ml-60');
        footer.classList.add('md:ml-58');
    } else {
        sideBar.style.transform = 'translateX(-100%)';
        konten.classList.remove('md:ml-60');
        footer.classList.remove('md:ml-58');
        }
    });

    function Login() {
        event.preventDefault();
        const loginForm = document.getElementById('Login');
        const registerForm = document.getElementById('registrasi');
        loginForm.classList.remove('hidden');
        loginForm.classList.add('grid');
        registerForm.classList.add('hidden');
    }
    function Regis() {
        event.preventDefault();
        const loginForm = document.getElementById('Login');
        const registerForm = document.getElementById('registrasi');
        registerForm.classList.remove('hidden');
        loginForm.classList.add('hidden');
    }
    function closePopup() {
    document.getElementById('popup-success').style.display = 'none';
    }