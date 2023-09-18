export function createNavbar() {
  const homeLink = '/';
  const coursesLink = '/courses';
  const graduatesLink = '/graduates';
  const classesLink = '/classes';
  const reportsLink = '/reports';
  const evaluationsLink = '/evaluations';
  const logoutLink = '/logout';

  const navbar = document.createElement('div');
  navbar.className = 'navbar';

  navbar.innerHTML = `

  <li></li>

  <ul>
    <li id="user">User</li>
    <li id="role">Role</li>
  </ul>

  <li></li>


    <ul>
      <li><a href="${homeLink}"><i class="fa fa-home"></i> Início</a></li>
      <li><a href="${coursesLink}"><i class="fa fa-institution"></i> Cursos</a></li>
      <li><a href="${graduatesLink}"><i class="fa fa-graduation-cap"></i> Formandos</a></li>
      <li><a href="${classesLink}"><i class="fa fa-spinner"></i> Turmas</a></li>
      <li><a href="${reportsLink}"><i class="fa fa-sticky-note-o"></i> Relatórios</a></li>
      <li><a href="${evaluationsLink}"><i class="fa fa-reorder"></i> Avaliações</a></li>
    </ul>

    <li></li>
    <li></li>
    
    <ul id="sair">
      <li><a href="${logoutLink}">SAIR</a></li>
    </ul>
  `;

  return navbar;
}
