import axios from "axios";

axios.defaults.baseURL = '/api';
// Create a new Axios instance
const instance = axios.create({
    withCredentials: true, // Send cookies with requests if needed
    headers: {
        'Content-Type': 'application/json',
        // Note: 'Access-Control-Allow-Origin' is a response header, not a request header.
        // It should be set by the server, not the client. Hence, this line is unnecessary.
    },
});

// Set the Authorization token from localStorage in the common headers
instance.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');

// Add a request interceptor
instance.interceptors.request.use(function (config) {
    // Do something before the request is sent
    // You can modify the request config here if needed
    return config;
}, function (error) {
    // Handle the request error
    return Promise.reject(error);
});

// Add a response interceptor
instance.interceptors.response.use(function (response) {
    // Any status code within the range of 2xx triggers this function
    // You can modify or log the response here
    return response;
}, function (error) {
    // Handle any status codes that fall outside the range of 2xx
    if (error.response && error.response.status === 401) {
        // Example: Handle unauthorized (401) response here (e.g., redirect to login)
    }
    return Promise.reject(error);
});

// Export the Axios instance for use throughout your app
export default instance;
