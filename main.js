const text = "ERDEM MARINE";
let index = 0;

function typeWriter() {
    if(index < text.length){
        document.getElementById("animatedText").innerHTML += text.charAt(index);
        index++;
        setTimeout(typeWriter, 150);
    }
}

window.onload = typeWriter;
function showTab(id) {
    // Tüm sekmeleri ve içerikleri pasifleştir
    document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));
  
    // Tıklanan sekme ve içeriği aktif hale getir
    document.getElementById(id).classList.add('active');
    document.querySelector(`.tab[onclick="showTab('${id}')"]`).classList.add('active');
  }
  