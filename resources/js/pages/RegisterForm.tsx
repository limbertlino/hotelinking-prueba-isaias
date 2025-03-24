import axios from 'axios';
import { FormEvent, useState } from 'react';
import { useNavigate } from 'react-router-dom';

export default function RegisterForm() {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const navigate = useNavigate();

    const handleSubmit = async (event: FormEvent<HTMLFormElement>) => {
        event.preventDefault();

        try {
            if (email && password) {
                const response = await axios.post('http://localhost:8000/api/register', {
                    email,
                    password,
                });
                console.log('Registro exitoso', response.data);
                setEmail('');
                setPassword('');
                navigate('/login');
            }
        } catch (error) {
            console.error('Error en el registro', error);
            setEmail('');
            setPassword('');
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <label htmlFor="email">Email</label>
            <input id="email" type="email" value={email} required onChange={(event) => setEmail(event.target.value)} />
            <label htmlFor="password">Password</label>
            <input type="password" id="password" value={password} required onChange={(event) => setPassword(event.target.value)} />
            <input type="submit" value="Registrarse" />
        </form>
    );
}
