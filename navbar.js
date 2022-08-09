let bar = document.querySelector(".handburger");
let box = document.querySelector(".container");
let menu = document.getElementById("nav");

bar.addEventListener("click", () => {
  box.classList.toggle("change");
  menu.classList.toggle("active");



  if (box.classList.value == "container change") {
    document.documentElement.style.overflow = "hidden";
  } else {
    document.documentElement.style.overflow = "auto";
  }
});



