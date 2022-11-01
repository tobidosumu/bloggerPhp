const [red, green, blue] = [242, 254, 255]
const header = document.querySelector('header')

window.addEventListener('scroll', () => {
  const y = 1 + (window.scrollY || window.pageYOffset) / 200
  const [r, g, b] = [red/y, green/y, blue/y].map(Math.ceil)
  header.style.boxShadow = `0 1px 4px rgb(${r}, ${g}, ${b})`
})