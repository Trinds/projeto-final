import {API_COURSES} from '/api.env'
import { messageModal } from '../components/message,js';

export async function editCourse(id,name, abbreviation) 
{
    try {
        const jsonData = {
            "id":id,
            "name": name,
            "abbreviation": abbreviation
        };

        const response = await fetch(API_COURSES, 
        {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(jsonData),
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const data = await response.json();

        messageModal("MODIFIED:  "+name, abbreviation);        ;
    } 
    catch (error) 
    {
        console.error('Error creating row:', error);
    }
}//-----------------------------------------