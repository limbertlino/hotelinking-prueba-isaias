import { AuthResponse, JSONAPIResponse } from '@/types/apiTypes';
import { AxiosResponse } from 'axios';

export const getToken = (response: AxiosResponse<AuthResponse>): string => {
    console.log(response);
    return response.data.data.token.attributes.token;
};
