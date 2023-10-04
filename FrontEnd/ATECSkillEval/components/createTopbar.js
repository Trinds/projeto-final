import '/styles/topbar.css'
import { CurrentPage } from '../services/currentPage'

const page= CurrentPage();
const btnDesc = 'Adicionar '+ page

export default function createTopbar(){
    const topbar = document.createElement('div')
    topbar.classList.add('top-bar')
    topbar.innerHTML=`
        <div class="search-input">
            <input type="search" class="custom-icon" placeholder="Pesquisar...">
        </div>
        <button id="addButton">${btnDesc}</button>
    `


    const addButton = topbar.querySelector('#addButton');

    if(window.location.pathname.includes("create") || window.location.pathname.includes("over"))
        addButton.classList.add("hide")
    else
        addButton.classList.remove("hide")
    
    addButton.addEventListener('click', () => 
    {        
        const createPage="/pages/"+ page + "/create.html"
        window.location.href= createPage;
    });

    document.querySelector('#content').prepend(topbar)
}