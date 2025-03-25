import { getToken } from '@/utils/jsonHelpers';
import axios from 'axios';

export const loginUser = async (email: string, password: string) => {
    const response = await axios.post('http://localhost:8000/api/login', {
        email,
        password,
    });
    return getToken(response);
};

export const registerUser = async (email: string, password: string) => {
    const response = await axios.post('http://localhost:8000/api/register', {
        email,
        password,
    });
    return response.data;
};
