async function getAllStudents(){
    const response = await fetch('http://127.0.0.1:8000/api/students/');
    const data = await response.json();
    return data;
}

