export function createNavbar() {
  const homeLink = '/pages/overviewpage.html';
  const coursesLink = '/pages/courses/';
  const graduatesLink ='/pages/students/';
  const classesLink = '/pages/classrooms/';
  const reportsLink = '/pages/reports/';
  const evaluationsLink = '/pages/evaluations/';
  const logoutLink = '/logout';

  const navbar = document.createElement('aside');
  navbar.className = 'navbar';

  navbar.innerHTML = `



  <ul>
    <li id="user">User</li>
    <li id="role">Role</li>
  </ul>



    <ul id= "menu">
      <li><a href="${homeLink}"><i class="fa fa-home"></i> Início</a></li>
      <li><a href="${coursesLink}"><i class="fa-regular fa-bookmark"></i> Cursos</a></li>
      <li><a href="${graduatesLink}"><i class="fa-solid fa-user-graduate"></i> Formandos</a></li>
      <li><a href="${classesLink}"><i class="fa-solid fa-users"></i> Turmas</a></li>
      <li><a href="${reportsLink}"><i class="fa fa-flag"></i> Relatórios</a></li>
      <li><a href="${evaluationsLink}"><i class="fa-solid fa-check"></i> Avaliações</a></li>
    </ul>


    
    <ul id="sair">
      <li><a href="${logoutLink}">SAIR</a></li>
    </ul>
  `;

  return navbar;
}
