function tampilkanPDF() {
    const select = document.getElementById("dokumenSelect");
    const pdfFrame = document.getElementById("pdfFrame");
    const container = document.getElementById("pdfContainer");

    if (select.value) {
        pdfFrame.src = select.value;
        container.style.display = "block";
    } else {
        container.style.display = "none";
        pdfFrame.src = "";
    }
}