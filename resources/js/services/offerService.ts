import api from '@/lib/api';
import { OffersResponse } from '@/types/offers';

/**
 * Fetches the list of offers available to the authenticated user.
 *
 * This function sends a GET request to the `/users/offers` endpoint to retrieve the offers associated with the authenticated user.
 *
 * @returns {Promise<OffersResponse>} A promise that resolves to the response data containing the list of offers.
 */
export const fetchUserOffers = async (): Promise<OffersResponse> => {
    const response = await api.get('/users/offers');
    return response.data;
};

/**
 * Claims an offer for the authenticated user by sending a POST request to the offer's claim endpoint.
 *
 * @param {string} id - The ID of the offer to be claimed.
 * @returns {Promise<void>} A promise that resolves when the offer has been claimed successfully.
 */
export const claimUserOffer = async (id: string): Promise<void> => {
    await api.post(`/offers/${id}/claim`);
};
