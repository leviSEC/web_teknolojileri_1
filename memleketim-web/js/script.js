// Slider için gereken JavaScript kodları
// Slider öğelerini seçme
const slider = document.querySelector(".slider");
const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".dot");

// Aktif slaytın indeksini izleme
let activeSlide = 0;

// Slayt geçişini gerçekleştiren fonksiyon
function showSlide(index) {
  // Tüm slaytları gizleme
  slides.forEach((slide) => slide.classList.remove("active"));
  // Tüm noktaları temizleme
  dots.forEach((dot) => dot.classList.remove("active"));
  // Belirtilen indeksteki slaytı gösterme
  slides[index].classList.add("active");
  // Belirtilen indeksteki noktayı işaretleme
  dots[index].classList.add("active");
}

// Slaytları otomatik olarak geçiş yapacak şekilde ayarlama
setInterval(() => {
  activeSlide++;
  if (activeSlide === slides.length) {
    activeSlide = 0;
  }
  showSlide(activeSlide);
}, 3000);

// Noktalara tıklanıldığında ilgili slaytı gösterme
dots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    activeSlide = index;
    showSlide(activeSlide);
  });
});
