import '../styles/evaluation.css'


const datePickerInput = document.getElementById('datePicker');
           
var currentDate = new Date();
var formattedDate = currentDate.toISOString().split('T')[0];
datePickerInput.value = formattedDate;
datePickerInput.type = 'date';



