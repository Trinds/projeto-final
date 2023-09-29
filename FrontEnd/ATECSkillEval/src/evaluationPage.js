import '../reset.css'
import '../style.css'
import '../styles/evaluation.css'
import { createSidebar } from '../components/createSidebar.js'
import createTopbar from "../components/createTopbar.js";
import { getAllStudents } from '../services/getStudents';
import { getAllClassRooms } from '../services/getClassrooms';
import { getAllTestTypes } from '../services/getTestTypes';

createSidebar()
createTopbar()

window.addEventListener("load", populateClass);
window.addEventListener("load", populateStudents);
window.addEventListener("load", populateTeste);

const datePickerInput = document.getElementById('datePicker');
var currentDate = new Date();
var formattedDate = currentDate.toISOString().split('T')[0];
datePickerInput.value = formattedDate;
datePickerInput.type = 'date';


async function populateStudents() 
{
    try 
    {
        const data = await  getAllStudents();

        data.sort((a, b) => 
        {
            const nameA = a.name.toUpperCase();
            const nameB = b.name.toUpperCase();
            if (nameA < nameB) return -1;
            if (nameA > nameB) return 1;
            return 0;
        });

        const dropdown = document.getElementById("select_aluno");

        data.forEach(student => 
        {
            const option = document.createElement("option");
            option.value = student.id; 
            option.textContent = student.name; 
            dropdown.appendChild(option);
        });
    } 
    catch (error) 
    {
        console.error("Error fetching data:", error);
    }
}//-------------------------------------------------------------------

async function populateClass() 
{    
    try 
    {
        const data = await getAllClassRooms()

        data.sort((a, b) => 
        {
            const courseNameA = a.course.name.toUpperCase();
            const courseNameB = b.course.name.toUpperCase();
            if (courseNameA < courseNameB) return -1;
            if (courseNameA > courseNameB) return 1;
            return 0;
        });

        const dropdown = document.getElementById("select_class");

        data.forEach(classroom => 
        {
            const option = document.createElement("option");
            option.value = classroom.id; 
            option.textContent = `${classroom.course.name} (${classroom.edition})`; 
            dropdown.appendChild(option);
        });
    } 
    catch (error) 
    {
        console.error("Error fetching data:", error);
    }
}//-----------------------------------------------------------------------------

async function populateTeste() 
{
    try 
    {
        const data = await getAllTestTypes();

        const dropdown = document.getElementById("select_test");

        data.forEach(test_types => 
        {
            const option = document.createElement("option");
            option.value = test_types.id; 
            option.textContent = test_types.type
            dropdown.appendChild(option);
        });
    } 
    catch (error) 
    {
        console.error("Error fetching data:", error);
    }
}//------------------------------------------------------------------------------
