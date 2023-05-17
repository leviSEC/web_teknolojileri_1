// Burada JavaScript kodları yer alacak
document.addEventListener("DOMContentLoaded", function () {
  const slides = document.querySelectorAll(".slide");
  const dotsContainer = document.createElement("div");
  dotsContainer.classList.add("slider-dots");

  slides.forEach((slide, index) => {
    if (index === 0) {
      slide.classList.add("active");
    }

    const dot = document.createElement("span");
    dot.classList.add("dot");
    dot.addEventListener("click", function () {
      setActiveSlide(index);
    });

    dotsContainer.appendChild(dot);
  });

  slides[0].parentNode.appendChild(dotsContainer);

  function setActiveSlide(index) {
    slides.forEach((slide, slideIndex) => {
      slide.classList.remove("active");

      if (slideIndex === index) {
        slide.classList.add("active");
      }
    });

    const dots = document.querySelectorAll(".dot");
    dots.forEach((dot, dotIndex) => {
      dot.classList.remove("active");

      if (dotIndex === index) {
        dot.classList.add("active");
      }
    });
  }
});

new Vue({
  el: "#contactForm",
  data: {
    name: "",
    email: "",
    message: "",
  },
  methods: {
    clearForm() {
      this.name = "";
      this.email = "";
      this.message = "";
    },
    validateForm() {
      // İsim, e-posta ve mesaj alanlarını kontrol et
      if (!this.name || !this.email || !this.message) {
        alert("Lütfen tüm alanları doldurun.");
        return;
      }

      // E-posta formatını kontrol et
      if (!this.validateEmail(this.email)) {
        alert("Lütfen geçerli bir e-posta adresi girin.");
        return;
      }

      // Formu gönder
      this.submitForm();
    },
    validateEmail(email) {
      // E-posta formatını kontrol et
      // Dilerseniz daha kapsamlı bir kontrol yapabilirsiniz
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    },
    submitForm() {
      // Formu gönderme işlemlerini gerçekleştirin
      // Örneğin, form verilerini başka bir sayfaya göndermek veya bir API'ye POST isteği yapmak
      // Burada form verilerini başka bir sayfada gösteriyoruz
      const formData = {
        name: this.name,
        email: this.email,
        message: this.message,
      };
      // Form verilerini başka bir sayfada gösteren sayfaya yönlendir
      window.location.href =
        "form-data.php?" + new URLSearchParams(formData).toString();
    },
  },
});
