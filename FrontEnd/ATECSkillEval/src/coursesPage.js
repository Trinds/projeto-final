import '../reset.css'
import '../style.css'
import '../styles/courses.css'
import { createSidebar } from '../components/createSidebar.js'
import createTopbar from "../components/createTopbar.js";
import { getAllCourses } from '../services/getCourses';

createSidebar()
createTopbar()

if (window.location.pathname.endsWith("courses/") || window.location.pathname.endsWith("index.html"))
        window.addEventListener("load", populateCourses);


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
        siglaCell.textContent = course.id;
  
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
  }
  