import {API_COURSES} from '/api.env'

export async function getAllCourses()
{
    const response = await fetch(API_COURSES);
    const data = await response.json();
    return data;
}
