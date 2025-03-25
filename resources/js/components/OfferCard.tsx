interface OfferCardProps {
    offer: {
        id: string;
        attributes: {
            title: string;
            description: string;
            discount: number;
        };
        meta?: {
            isClaimed?: boolean;
        };
    };
    onClaim?: (id: string) => void;
}

export default function OfferCard({ offer, onClaim }: OfferCardProps) {
    return (
        <div key={offer.id}>
            <h3>{offer.attributes.title}</h3>
            <p>{offer.attributes.description}</p>
            <p>{offer.attributes.discount}% OFF</p>
            <button onClick={() => onClaim?.(offer.id)} disabled={offer.meta?.isClaimed}>
                {offer.meta?.isClaimed ? 'Claimed' : 'Claim'}
            </button>
        </div>
    );
}
