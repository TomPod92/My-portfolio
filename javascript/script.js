const left = document.querySelector('.bigBox__left');
const right = document.querySelector('.bigBox__right');

left.addEventListener("mouseenter", () => {
    left.classList.add("hover");
    right.classList.add("smaller");
});

left.addEventListener("mouseleave", () => {
    left.classList.remove("hover");
    right.classList.remove("smaller");
});

right.addEventListener("mouseenter", () => {
    right.classList.add("hover");
    left.classList.add("smaller");
});

right.addEventListener("mouseleave", () => {
    right.classList.remove("hover");
    left.classList.remove("smaller");
});