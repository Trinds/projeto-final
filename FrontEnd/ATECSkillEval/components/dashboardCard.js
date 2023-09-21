export default function dashboardCard(name, count, iconClass, backgroundClass){
    const dashboardCard = document.createElement('div')
    dashboardCard.classList.add('dashboard-card',`${backgroundClass}`)
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