import api from '@/lib/api';
import { CodesResponse } from '@/types/codes';

export const fetchUserCodes = async (): Promise<CodesResponse> => {
    const response = await api.get('/users/codes');
    return response.data;
};
