const apiKey = "09cf7cf947565beeaa4d7f1791ba2dc3";
// İlgi alanlarınızı belirleyin (örneğin film türleri)
const interests = ["Aksiyon"];

// TMDB API'den film verilerini almak için istek yapın
function getMovies() {
  const promises = interests.map((interest) => {
    const url = `https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&with_genres=${encodeURIComponent(
      interest
    )}`;
    return fetch(url).then((response) => response.json());
  });

  Promise.all(promises)
    .then((results) => {
      const interestsContainer = document.getElementById("interests-container");

      results.forEach((result, index) => {
        const interestMovies = result.results.slice(0, 15);
        const interestElement = document.createElement("div");
        interestElement.classList.add("interest");

        const titleElement = document.createElement("h3");
        titleElement.textContent = interests[index];
        interestElement.appendChild(titleElement);

        const moviesList = document.createElement("ul");

        interestMovies.forEach((movie) => {
          const movieItem = document.createElement("li");

          // Film afişi için bir <img> elementi oluşturun
          const moviePoster = document.createElement("img");
          moviePoster.src = `https://image.tmdb.org/t/p/w500/${movie.poster_path}`;
          moviePoster.alt = movie.title;
          movieItem.appendChild(moviePoster);

          // Film başlığını gösteren bir <p> elementi oluşturun
          const movieTitle = document.createElement("p");
          movieTitle.textContent = movie.title;
          movieItem.appendChild(movieTitle);

          // Film puanını göstermek için bir <p> elementi oluşturun
          const movieRating = document.createElement("p");
          movieRating.textContent = `Puan: ${movie.vote_average}`;
          movieItem.appendChild(movieRating);

          // Film açıklamasını göstermek için bir <p> elementi oluşturun
          const movieOverview = document.createElement("p");
          movieOverview.textContent = movie.overview;
          movieItem.appendChild(movieOverview);

          // Film yayın tarihini göstermek için bir <p> elementi oluşturun
          const movieReleaseDate = document.createElement("p");
          movieReleaseDate.textContent = `Yayın Tarihi: ${movie.release_date}`;
          movieItem.appendChild(movieReleaseDate);

          moviesList.appendChild(movieItem);
        });

        interestElement.appendChild(moviesList);
        interestsContainer.appendChild(interestElement);
      });
    })
    .catch((error) => console.log(error));
}

// Sayfa yüklendiğinde ilgi alanlarını alın ve gösterin
document.addEventListener("DOMContentLoaded", getMovies);
