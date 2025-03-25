import api from '@/lib/api';
import { OffersResponse } from '@/types/offers';

export const fetchUserOffers = async (): Promise<OffersResponse> => {
    const response = await api.get('/users/offers');
    return response.data;
};

export const claimUserOffer = async (id: string): Promise<void> => {
    await api.post(`/offers/${id}/claim`);
};
