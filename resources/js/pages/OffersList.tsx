import api from '@/api';
import { OffersResponse } from '@/types/offers';
import { produce } from 'immer';
import { useEffect, useState } from 'react';

export default function OffersList() {
    const [offers, setOffers] = useState<OffersResponse | null>(null);

    useEffect(() => {
        const fetchOffers = async () => {
            try {
                const response = await api.get('/users/offers');
                let data = response.data;
                setOffers(response.data);
            } catch (error) {
                console.error('Error fetching codes:', error);
            }
        };

        fetchOffers();
    }, []);

    if (!offers) {
        return <div>Cargando ofertas...</div>;
    }

    const claimOffer = async (id: string) => {
        try {
            setOffers(
                produce((draft) => {
                    const offer = draft?.data?.offers.find((o) => o.id === id);
                    if (offer) offer.meta.isClaimed = true;
                }),
            );

            const response = await api.post(`http://localhost:8000/api/offers/${id}/claim`);
            console.log(response.data);
        } catch (error) {
            setOffers(
                produce((draft) => {
                    const offer = draft?.data?.offers.find((o) => o.id === id);
                    if (offer) offer.meta.isClaimed = false;
                }),
            );

            console.error('Claimed error', error);
        }
    };

    return (
        <>
            <p>Offers</p>
            {offers.data.offers.map((offer) => {
                return (
                    <div key={offer.id}>
                        <h1>{offer.attributes.title}</h1>
                        <p>{offer.attributes.description}</p>
                        <h2>{offer.attributes.discount}% OFF!</h2>
                        <button onClick={() => claimOffer(offer.id)} disabled={offer.meta.isClaimed}>
                            {offer.meta.isClaimed ? 'Claimed' : 'Claim'}
                        </button>
                    </div>
                );
            })}
        </>
    );
}
