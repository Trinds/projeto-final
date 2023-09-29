export async function getAllTestTypes()
{
    const response = await fetch('http://127.0.0.1:8000/api/test_types/');
    const data = await response.json();
    return data;
}
