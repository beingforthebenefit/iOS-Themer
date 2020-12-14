/*Hamburger Menu*/
const navMenu = document.getElementById('nav-menu'),
    toggleMenu = document.getElementById('nav-toggle'),
    closeMenu = document.getElementById('nav-close')

// show
toggleMenu.addEventListener('click', ()=>{
    navMenu.classList.toggle('show')
})

// hiddn
closeMenu.addEventListener('click', ()=>{
    navMenu.classList.remove('show')
})

/*===== mouse hover animation ( thanks to the dudes on codepen.io for the tutorial) =====*/
document.addEventListener('mousemove', move);
function move(e){
    this.querySelectorAll('.move').forEach(layer =>{
        const speed = layer.getAttribute('data-speed')

        const x = (window.innerWidth - e.pageX*speed)/120
        const y = (window.innerHeight - e.pageY*speed)/120

        layer.style.transform = `translateX(${x}px) translateY(${y}px)`
    })
}

/*===== gsap animation code =====*/
// NAV
gsap.from('.nav__logo, .nav__toggle', {opacity: 0, duration: 1, delay:2, y: 10})
gsap.from('.nav__item', {opacity: 0, duration: 1, delay: 2.1, y: 30, stagger: 0.2,})

// main transitions
gsap.from('.main__title', {opacity: 0, duration: 1, delay:1.6, y: 30})
gsap.from('.main__description', {opacity: 0, duration: 1, delay:1.8, y: 30})
gsap.from('.main__img', {opacity: 0, duration: 1, delay:1.3, y: 30})

// homepage
gsap.from('.try_now_button', {opacity: 0, duration: 1, delay:2.1, y: 30})

// howtopage
gsap.from('.store-button', {opacity: 0, duration: 1, delay:2.1, y: 30})

// icon-packs-page

// iosthemer
gsap.from('.installer', {opacity: 0, duration: 1, delay: 1.3, y: 30})