import { getToken } from '@/utils/jsonHelpers';
import axios from 'axios';

/**
 * Logs in the user by sending a POST request with email and password.
 *
 * This function sends the user's credentials to the login endpoint and retrieves the authentication token
 * from the response.
 *
 * @param {string} email - The user's email address.
 * @param {string} password - The user's password.
 * @returns {Promise<string>} The authentication token.
 */
export const loginUser = async (email: string, password: string) => {
    const response = await axios.post('http://localhost:8000/api/login', {
        email,
        password,
    });
    return getToken(response);
};

/**
 * Registers a new user by sending a POST request with email and password.
 *
 * This function sends the user's credentials to the register endpoint and returns the response data.
 *
 * @param {string} email - The user's email address.
 * @param {string} password - The user's password.
 * @returns {Promise<any>} The response data from the register API.
 */
export const registerUser = async (email: string, password: string) => {
    const response = await axios.post('http://localhost:8000/api/register', {
        email,
        password,
    });
    return response.data;
};
