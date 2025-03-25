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
            {/* <div className="container mx-auto p-4">
                <h2 className="mb-4 text-center text-xl font-bold">Ofertas</h2>
                <div className="grid grid-cols-1 place-items-center gap-6 sm:grid-cols-2 md:grid-cols-2">
                    {offers.data.offers.map((offer) => {
                        return <OfferCard key={offer.id} offer={offer} onClaim={claimOffer} />;
                    })}
                </div>
            </div> */}
            <div className="container mx-auto p-4">
                <h2 className="mb-4 text-center text-xl font-bold">Ofertas</h2>
                <div className="grid grid-cols-1 place-items-center items-stretch gap-6 sm:grid-cols-2 md:grid-cols-2">
                    {offers.data.offers.map((offer) => (
                        <OfferCard key={offer.id} offer={offer} onClaim={claimOffer} />
                    ))}
                </div>
            </div>
        </>
    );
}
