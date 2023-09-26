import '/styles/navbar.css'
export function createSidebar() {
  const homeLink = '/pages/overviewPage.html';
  const coursesLink = '/pages/courses/';
  const studentsLink ='/pages/students/';
  const classroomsLink = '/pages/classrooms/';
  const reportsLink = '/pages/reports/';
  const evaluationsLink = '/pages/evaluations/';
  const logoutLink = '/logout';

  const app = document.querySelector('body');

  const navbar = document.createElement('aside');
  navbar.className = 'navbar';

  navbar.innerHTML = `
  <ul>
    <li class="app-title">
        <svg width="6" height="39" viewBox="0 0 6 39" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 0L3 39" stroke="#F8D442" stroke-width="6"/>
        </svg>
        <p>ATEC SkillEval</p>
    </li>
    <li id="user">User</li>
    <li id="role">Role</li>
  </ul>

    <ul id= "menu">
      <li id="toHome"><div class="icon"><i class="fa fa-home"></i></div>Início</li>
      <li id="toCourses"><div class="icon"><i class="fa-regular fa-bookmark"></i></div>Cursos</li>
      <li id="toStudents"><div class="icon"><i class="fa-solid fa-user-graduate"></i></div>Formandos</li>
      <li id="toClassrooms"><div class="icon"><i class="fa-solid fa-users"></i></div>Turmas</li>
      <li id="toReports"><div class="icon"><i class="fa fa-flag"></i></div>Relatórios</li>
      <li id="toEvaluations"><div class="icon"><i class="fa-solid fa-check"></i></div>Avaliações</li>
    </ul>
    
    <ul id="sair">
      <li <li <i class="fa-solid fa-arrow-right-from-bracket"></i><a href="${logoutLink}">SAIR </a></li>      
    </ul>
  `;

  app.prepend(navbar)

  document.querySelector('#toHome').addEventListener('click',()=>{
    location.href=homeLink
  })
  document.querySelector('#toCourses').addEventListener('click',()=>{
    location.href=coursesLink
  })
  document.querySelector('#toStudents').addEventListener('click',()=>{
    location.href=studentsLink
  })
  document.querySelector('#toClassrooms').addEventListener('click',()=>{
    location.href=classroomsLink
  })
  document.querySelector('#toReports').addEventListener('click',()=>{
    location.href=reportsLink
  })
  document.querySelector('#toEvaluations').addEventListener('click',()=>{
    location.href=evaluationsLink
  })

}
