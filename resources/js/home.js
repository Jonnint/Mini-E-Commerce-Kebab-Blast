// JS halaman beranda - tombol "Baca selengkapnya" di About Us

var tombolBaca = document.querySelectorAll('.btn-baca');

tombolBaca.forEach(function (tombol) {
    tombol.addEventListener('click', function () {
        var idTeks = tombol.getAttribute('data-target');
        var teks = document.getElementById(idTeks);

        if (teks.classList.contains('hidden')) {
            teks.classList.remove('hidden');
            tombol.textContent = 'Sembunyikan';
        } else {
            teks.classList.add('hidden');
            tombol.textContent = 'Baca selengkapnya';
        }
    });
});
