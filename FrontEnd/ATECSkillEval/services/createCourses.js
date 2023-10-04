import {API_COURSES} from '/api.env'
import { messageModal } from '../components/message,js';

export async function createCourse(name, abbreviation) 
{
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

        const t1='curso creado com sucesso'
        const t2='NOME: ' + name + '<br> <br> SIGLA:  ' + abbreviation
        messageModal(t1,t2);      
    } 
    catch (error) 
    {
        console.error('Error creating row:', error);
    }
}//-----------------------------------------