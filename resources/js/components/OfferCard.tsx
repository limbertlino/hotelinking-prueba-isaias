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
        <div className="flex h-full w-80 flex-col rounded-lg border bg-white p-4 shadow-lg">
            {/* Título resaltado con fondo gris */}
            <div className="rounded-md bg-gray-100 p-3 text-center">
                <h3 className="text-2xl font-bold text-gray-900">{offer.attributes.title}</h3>
            </div>
            {/* Descripción de la oferta */}
            <p className="mt-2 flex-grow text-gray-700">{offer.attributes.description}</p>
            {/* Descuento destacado */}
            <div className="mt-2 flex items-center justify-between">
                <p className="text-gray-500">Descuento</p>
                <p className="text-lg font-bold text-gray-900">{offer.attributes.discount}% OFF</p>
            </div>
            {/* Botón de reclamo */}
            <button
                onClick={() => onClaim?.(offer.id)}
                disabled={offer.meta?.isClaimed}
                className={`mt-4 w-full rounded-md py-2 font-bold text-white transition ${
                    offer.meta?.isClaimed ? 'cursor-not-allowed bg-gray-400' : 'bg-blue-600 hover:bg-blue-700'
                }`}
            >
                {offer.meta?.isClaimed ? 'Oferta Reclamada' : 'Reclamar Oferta'}
            </button>
        </div>
    );
}
