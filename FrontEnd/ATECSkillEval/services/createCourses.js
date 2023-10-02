import {API_COURSES} from '/api.env'

export async function createCourse(name, abbreviation) {
    try {
        const jsonData = {
            "name": name,
            "abbreviation": abbreviation
        };

        const response = await fetch(API_COURSES, 
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(jsonData),
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const data = await response.json();

        console.log('New row created:', data);
    } catch (error) {
        console.error('Error creating row:', error);
    }
}//-----------------------------------------