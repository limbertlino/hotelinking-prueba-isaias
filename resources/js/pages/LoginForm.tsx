import axios from 'axios';
import { FormEvent, useState } from 'react';
import { useNavigate } from 'react-router-dom';

export function LoginForm() {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const navigate = useNavigate();

    const handleSubmit = async (event: FormEvent<HTMLFormElement>) => {
        event.preventDefault();

        try {
            if (email && password) {
                const response = await axios.post('http://localhost:8000/api/login', {
                    email,
                    password,
                });
                console.log(response.data);
                const token = response.data.data.token.attributes.token;

                localStorage.setItem('authToken', token);

                navigate('/offers');

                setEmail('');
                setPassword('');
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
            <input type="submit" value="Ingresar" />
        </form>
    );
}
