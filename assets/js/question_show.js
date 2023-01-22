const container = document.querySelectorAll(".js-vote-arrows");
container.forEach((container) => {
  container.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      fetch("/comments/10/vote/" + e.currentTarget.dataset.direction, {
        method: "POST",
      })
        .then((response) => {
          return response.json();
        })
        .then((data) => {
          console.log(data);
          container.querySelector(".js-vote-total").innerHTML = data.votes;
        });
    });
  });
});
