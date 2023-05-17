window.addEventListener("DOMContentLoaded", () => {
  const interestsContainer = document.getElementById("interests-container");

  // API'den veri almak için XMLHttpRequest kullanalım
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "https://example.com/api/interests", true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      const interests = JSON.parse(xhr.responseText);

      // Verileri HTML içine yerleştirelim
      let interestsHTML = "";
      interests.forEach((interest) => {
        interestsHTML += `
          <div class="interest">
            <h3>${interest.name}</h3>
            <p>${interest.description}</p>
          </div>
        `;
      });

      interestsContainer.innerHTML = interestsHTML;
    }
  };

  xhr.onerror = function () {
    console.error("Bir hata oluştu.");
  };

  xhr.send();
});
