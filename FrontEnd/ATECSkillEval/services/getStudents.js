async function populateDropdown() 
{
    const apiUrl = "http://127.0.0.1:8000/api/students/";

    try 
    {
        const response = await fetch(apiUrl);
        const data = await response.json();

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

window.addEventListener("load", populateDropdown);