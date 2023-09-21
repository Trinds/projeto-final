export default function dashboardCard(name, count, iconClass){
    const dashboardCard = document.createElement('div')
    dashboardCard.classList.add('dashboard-card')
    dashboardCard.innerHTML=`
    <div class="left">
                <h1>${count}</h1>
                <p>${name}</p>
            </div>
            <div class="right">
                <i class="${iconClass}"></i>
            </div>
    `
    return dashboardCard
}