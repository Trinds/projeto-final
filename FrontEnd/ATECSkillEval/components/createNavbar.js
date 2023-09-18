
export function createNavbar() 
{
    const navbar = document.createElement('div');
    navbar.className = 'navbar';
    navbar.innerHTML=`

      <ul>

        <li></li>

        <ul>
          <li id="user">User</li>
          <li id="role">Role</li>
        </ul>

        <li></li>

        <ul id="menu">
          <li><i class="fa fa-home" aria-hidden="true"></i> Início</li>
          <li><i class="fa fa-institution" aria-hidden="true"></i> Cursos</li>
          <li><i class="fa fa-graduation-cap" aria-hidden="true"></i> Formandos</li>
          <li><i class="fa fa-spinner" aria-hidden="true"></i> Turmas</li>
          <li><i class="fa fa-sticky-note-o" aria-hidden="true"></i>  Relatórios</li>
          <li><i class="fa fa-reorder" aria-hidden="true"></i> Avaliações</li>
        </ul>

        <li></li>
        <li></li>

        <ul id="sair">
          <li>SAIR</i>
        </ul>
      
    `;
    return navbar;
}