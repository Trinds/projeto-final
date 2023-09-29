export async function getAllClassRooms()
{
    const response = await fetch('http://127.0.0.1:8000/api/classrooms/');
    const data = await response.json();
    return data;
}
