async function getAllStudents(){
    const response = await fetch('http://127.0.0.1:8000/api/students/');
    const data = await response.json();
    return data;
}


window.addEventListener("load", populateClass);
window.addEventListener("load", populateStudents);
window.addEventListener("load", populateTeste);




async function populateStudents() 
{
    const apiUrl = "http://127.0.0.1:8000/api/students/";

    try 
    {
        const response = await fetch(apiUrl);
        const data = await response.json();

        data.sort((a, b) => {
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
}

async function populateClass() 
{
    const apiUrl = "http://127.0.0.1:8000/api/classrooms/";

    try 
    {
        const response = await fetch(apiUrl);
        const data = await response.json();


        data.sort((a, b) => {
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
}

async function populateTeste() 
{
    const apiUrl = "http://127.0.0.1:8000/api/test_types/";

    try 
    {
        const response = await fetch(apiUrl);
        const data = await response.json();




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
}
