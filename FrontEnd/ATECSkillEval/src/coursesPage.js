import '../reset.css'
import '../style.css'
import '../styles/courses.css'
import createTopbar from "../components/createTopbar.js";
import { createSidebar } from '../components/createSidebar.js'
import { getAllCourses } from '../services/getCourses';
import { createCourse } from '../services/createCourses';

createSidebar()
createTopbar()

if (window.location.pathname.endsWith("courses/") || window.location.pathname.endsWith("index.html"))
        window.addEventListener("load", populateCourses);
else if (window.location.pathname.endsWith("courses/create.html"))
        window.addEventListener("load", courseCreation);
else if (window.location.pathname.endsWith("courses/details.html"))
        window.addEventListener("load", courseEdition);


async function populateCourses() 
{
    const table = document.getElementById("coursesTable");  
    try 
    {
      const data = await getAllCourses();  
    
      table.innerHTML = ""; 
    
      const headerRow = document.createElement("tr");
      headerRow.innerHTML = 
      `
        <th scope="col">Sigla</th>
        <th scope="col">Nome</th>
        <th></th>
      `;
      table.appendChild(headerRow);
  
      
      data.forEach(course => 
    {
        const row = document.createElement("tr");
        row.className = "table-row";
  
        const siglaCell = document.createElement("td");
        siglaCell.textContent = course.abbreviation;
  
        const nomeCell = document.createElement("td");
        nomeCell.textContent = course.name;
  
        const actionsCell = document.createElement("td");
        actionsCell.innerHTML = 
        `
          <i class="fa-solid fa-magnifying-glass detailsBtn"></i>
          <i class="fa-solid fa-pencil editBtn"></i>
          <i class="fa-regular fa-trash-can removeBtn"></i>
        `;
  
  
        row.appendChild(siglaCell);
        row.appendChild(nomeCell);
        row.appendChild(actionsCell);  
  
        table.appendChild(row);
    });
    } 
    catch (error) 
    {
      console.error("Error fetching data:", error);
    }
  }//---------------------------------------------------
  
  async  function courseCreation()
  {
    const form = document.querySelector('form');  
  
    form.addEventListener('submit', function (event) 
    {    
      event.preventDefault();
      
      const name = document.getElementById('name').value;
      const abbreviation = document.getElementById('abbreviation').value;  
    
      createCourse(name,abbreviation)
    });
  }//-----------------------------------------------------  
  
  async  function courseEdition(id)
  {
    const form = document.querySelector('form');  
  
    form.addEventListener('submit', function (event) 
    {    
      event.preventDefault();
      
      const name = document.getElementById('name').value;
      const abbreviation = document.getElementById('abbreviation').value;  
    
      updateCourse(id,name,abbreviation)
    });
  }//-----------------------------------------------------