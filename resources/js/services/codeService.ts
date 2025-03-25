import api from '@/lib/api';
import { CodesResponse } from '@/types/codes';

/**
 * Fetches the list of codes for the authenticated user.
 *
 * This function sends a GET request to the `/users/codes` endpoint to retrieve the codes associated with the authenticated user.
 *
 * @returns {Promise<CodesResponse>} A promise that resolves to the response data containing the list of codes.
 */
export const fetchUserCodes = async (): Promise<CodesResponse> => {
    const response = await api.get('/users/codes');
    return response.data;
};
