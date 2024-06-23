import { defineStore } from 'pinia';
import axios from '@/plugins/axios';



export const useUserStore = defineStore('user', {
    state: () => ({
        token: null,
        isLoading: false,
        error: null,

    }),
    // getters: {
    //     isLoggedIn(state){
    //         return !!state.token
    //     },
    //     error(){
    //         return state => state.error
    //     }
    //     // token: state => state.token,
    // },
    actions: {

        async register(name,last_name, email, password, selectedRole) {
            this.isLoading = true;
            this.error = null;
             try {

                // Realizar la solicitud de registro
                const response = await axios.post('/register', {
                    name,
                    last_name,
                    email,
                    password,
                    role: selectedRole || 'authenticated_client', // Default to authenticated_client if role is empty
                });


                // Guardar el token y el usuario en el estado
                this.token = response.data.token;

                this.responseCode = response.status;
                this.responseMessage = response.data.message;

                // Configurar el token en los headers de Axios para futuras solicitudes
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;

                // // Hacer una solicitud para obtener los datos del usuario registrado
                const userResponse = await axios.get('/user');
                this.user = userResponse.data;

                console.log('Usuario registrado:', this.user.name);
                console.log('Registro exitoso', response.data);
            } catch (error) {
                console.error('Error al registrar usuario', error);
                this.error = error.response.data.message || 'Error al registrar usuario';
            } finally {
                this.isLoading = false;
            }
        },
        async login(email, password) {
            this.error = null;
            this.isLoading = true;

            try {
                // Perform login request
                const response = await axios.post('/login', {
                    email,
                    password
                });

                // Save token and user to state
                 this.token = response.data.token;

                // Set the token in Axios headers for future requests
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;

                localStorage.setItem('token', this.token); // Almacena el token en el localStorage

                //  // Request user data after successful login
                // const userResponse = await axios.get('/user');
                // this.user = userResponse.data;

                // console.log('Logged-in user:', this.user.name);
                console.log('message:',response.data.message);
                console.log('token', response.data.token);


            } catch (error) {
                // Manejar errores de inicio de sesión
                if (error.response && error.response.status === 401) {
                    console.error(error.response.data.message || 'Las credenciales proporcionadas son incorrectas.');
                    this.error = error.response.data.message || 'Las credenciales proporcionadas son incorrectas.';
                } else {
                    console.error('Error al iniciar sesión', error);
                    this.error = 'Error al iniciar sesión';
                }
            } finally {
                this.isLoading = false;
            }
        },

        async logout() {
            try {
                // Realiza una solicitud de logout a la API
                const response = await axios.post('logout');

                localStorage.removeItem('token');

                console.log('Logged-out user:', this.user.name);
                console.log('message:',response.data.message);

            } catch (error) {
                // Manejar errores de inicio de sesión
                if (error.response && error.response.status === 401) {
                    console.error(error.response.data.message || 'Las credenciales proporcionadas son incorrectas.');
                } else {
                    console.error('Error al iniciar sesión', error);
                }
                // Establecer un estado de error para uso futuro
                this.error = error.response ? error.response.data.message : 'Error al iniciar sesión';
            } finally {
                this.isLoading = false;
            }
        },
    }
});



// // Primero, obtener el token CSRF
// axios.get('http://127.0.0.1:8000/sanctum/csrf-cookie').then(response => {
//     // Luego, hacer la solicitud de login
//     axios.post('http://127.0.0.1:8000/api/login', {
//         email: 'admin@gmail.com',
//         password: '12345678'
//     }).then(response => {
//         console.log('Login exitoso', response.data);
//     }).catch(error => {
//         console.error('Error al iniciar sesión', error);
//     });
// });




