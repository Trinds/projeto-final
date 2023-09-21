import '/styles/topbar.css'

export default function createTopbar(){
    const topbar = document.createElement('div')
    topbar.classList.add('top-bar')
    topbar.innerHTML=`
    <i class="fa-solid fa-circle-chevron-left fa-xl"></i>
        <div class="search-input">
            <input type="search" class="custom-icon" placeholder="Pesquisar...">
        </div>
    `
    document.querySelector('#content').prepend(topbar)
}