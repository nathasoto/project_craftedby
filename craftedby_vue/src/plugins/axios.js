import axios from 'axios';

const axiosInstance = axios.create({
    baseURL: 'http://127.0.0.1:8000/api', // Base URL of your Laravel API
    withCredentials: true, // Allow sending cookies along with the request (necessary for CSRF cookie)
});

// Request CSRF cookie at the beginning of client connection
axiosInstance.get('http://127.0.0.1:8000/sanctum/csrf-cookie').then(response => {
    // Successfully obtained CSRF cookie
    console.log('CSRF cookie obtained:', response.status);
}).catch(error => {
    // Handle errors when obtaining CSRF cookie
    console.error('Error obtaining CSRF cookie:', error);
});

export default axiosInstance;
