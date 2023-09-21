import '../reset.css'
import '../style.css'
import '../styles/evaluation.css'
import { createSidebar } from '../components/createSidebar.js'
import createTopbar from "../components/createTopbar.js";


createSidebar()
createTopbar()

const datePickerInput = document.getElementById('datePicker');
           
var currentDate = new Date();
var formattedDate = currentDate.toISOString().split('T')[0];
datePickerInput.value = formattedDate;
datePickerInput.type = 'date';



