import OfferCard from '@/components/OfferCard';
import { claimUserOffer, fetchUserOffers } from '@/services/offerService';
import { OffersResponse } from '@/types/offers';
import { produce } from 'immer';
import { useEffect, useState } from 'react';

export default function OffersList() {
    const [offers, setOffers] = useState<OffersResponse | null>(null);

    useEffect(() => {
        const fetchOffers = async () => {
            try {
                const data = await fetchUserOffers();
                setOffers(data);
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

            await claimUserOffer(id);
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
                return <OfferCard key={offer.id} offer={offer} onClaim={claimOffer} />;
            })}
        </>
    );
}
