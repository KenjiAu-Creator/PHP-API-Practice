const button = document.getElementById("request");
const albumList = document.getElementById("albums");

button.addEventListener("click", (event) => {
  event.preventDefault();
  fetch("http://localhost:3000/api/songs.php")
    .then((response) => response.json())
    .then((data) => {
      for(let album in data) {
        // Iterate through the list of albums and output album name.
        const albumTitle = document.createElement("H2");
        albumTitle.innerHTML = album;
        albumList.append(albumTitle);
        for(let song of data[album]) {
          // Iterate through the album and output each song name.
          const songLI = document.createElement("LI");
          songLI.innerHTML = song;
          albumList.append(songLI);
        }
      }
    });
});
