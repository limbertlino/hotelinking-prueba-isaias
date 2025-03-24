import api from '@/api';
import { useEffect, useState } from 'react';

export default function OffersList() {
    const [offers, setOffers] = useState([]);

    useEffect(() => {
        const fetchOffers = async () => {
            try {
                const response = await api.get('/users/offers');
                let data = response.data;
                console.log(data);
                setOffers(response.data);
            } catch (error) {
                console.error('Error fetching codes:', error);
            }
        };

        fetchOffers();
    }, []);

    return <div>Listado de ofertas</div>;
}
