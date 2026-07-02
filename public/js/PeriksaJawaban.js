const jawabanBenar = {
    'VSK': {
        q1 : 'a',
        q2 : 'a',
    },'AIS' : {
        q1 : 'a',
        q2 : 'a',
    },'HM' : {
        q1 : 'a',
        q2 : 'c',
    },'HS' : {
        q1 : 'a',
        q2 : 'b',
    }   
};
function cekJawabanVerifikasi(kode) {
    const kunci = jawabanBenar[kode];
    if (!kunci) {
        alert('Kunci jawaban tidak ditemukan!');
        return;
    }
    const jawabanUser = {
        q1: document.querySelector('input[name="q1"]:checked')?.value,
        q2: document.querySelector('input[name="q2"]:checked')?.value,
    };
    let score = 0;
    const form = document.getElementById("form-verifikasi");
    const data = new FormData(form);
    const nilaiInput = document.getElementById('nilai-input');
    for (const soal in kunci) {
        if (jawabanUser[soal] === kunci[soal]) {
            score += 100/Object.keys(kunci).length; // Nilai per soal
        }
    }
    const nilaiElement = document.getElementById('nilai');
    if (nilaiElement) {
        // alert('Memeriksa jawaban...');
        nilaiElement.textContent = `${score}`;
        // console.log("Memeriksa jawaban untuk kode:", kode);
    }
    // console.log("CLICKED");
    // console.log("FORM:", form);
    // console.log("SCORE:", score);
    // alert(`Skor kamu: ${score}/${Object.keys(kunci).length}`);
    if (score == 100) {
        nilaiInput.value = score;
        // console.log("Nilai input sebelum submit:", nilaiInput.value);
        form.requestSubmit();
    }
}