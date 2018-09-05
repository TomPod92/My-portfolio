const left = document.querySelector('.bigBox__left');
const right = document.querySelector('.bigBox__right');


formAnimation = () => {
    let screen =  window.innerWidth;

    if(screen >= 600) {
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
    } else removeClass();

    console.log(screen);
};

window.addEventListener("resize", formAnimation);

removeClass = ()=> {

    console.log('class removed');
    left.classList.remove("hover");
    right.classList.remove("smaller");

    right.classList.remove("hover");
    left.classList.remove("smaller");
};



// // rotate project card after clicking on a button

// document.querySelector('.project__card--rotate-button').addEventListener('click', () => {
//     document.querySelector('.project__card--front').
// });

