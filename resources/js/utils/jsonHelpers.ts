import { AuthResponse } from '@/types/apiTypes';
import { AxiosResponse } from 'axios';

export const getToken = (response: AxiosResponse<AuthResponse>): string => {
    return response.data.data.token.attributes.token;
};
