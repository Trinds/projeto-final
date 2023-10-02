import '/styles/topbar.css'

const btnDesc = 'Adicionar "Cena"'
export default function createTopbar(){
    const topbar = document.createElement('div')
    topbar.classList.add('top-bar')
    topbar.innerHTML=`
        <div class="search-input">
            <input type="search" class="custom-icon" placeholder="Pesquisar...">
        </div>
        <button>${btnDesc}</button>
    `
    document.querySelector('#content').prepend(topbar)
}