function toggleDetail(id) {

        const detail = document.getElementById(id);
        const icon = document.getElementById('icon-' + id);

        detail.classList.toggle('hidden');

        icon.classList.toggle('rotate-180');
    }