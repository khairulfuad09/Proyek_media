    function toggleMenu(number) {
        const submenu = document.getElementById('submenu'+number);
        const arrow = document.getElementById('arrowIcon'+number);

        submenu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }
