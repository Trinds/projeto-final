import '/styles/overviewpage.css'
import dashboardCard from "./dashboardCard.js"

export default function createDashboard(){
    const dashboard = document.createElement('div')
    dashboard.classList.add('dashboard-container')

    dashboard.appendChild(dashboardCard('Formandos', 1500,'fa-solid fa-user-graduate fa-2xl'))
    dashboard.appendChild(dashboardCard('Turmas', 75,'fa-solid fa-users fa-2xl'))
    dashboard.appendChild(dashboardCard('Cursos', 10,'fa-regular fa-bookmark fa-2xl'))
    dashboard.appendChild(dashboardCard('Avaliações', 2756,'fa-solid fa-check fa-2xl'))
    dashboard.appendChild(dashboardCard('Utilizadores', 7,'fa-solid fa-circle-user fa-2xl'))

    document.querySelector('#content').appendChild(dashboard)
}