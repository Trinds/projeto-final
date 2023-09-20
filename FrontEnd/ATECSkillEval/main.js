import './reset.css'
import './style.css'
import './styles/navbar.css'
import { createNavbar } from './components/createNavbar';

const app = document.getElementById('navbar');
app.appendChild(createNavbar())