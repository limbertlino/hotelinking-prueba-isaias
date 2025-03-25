import React from 'react';

interface OfferAttributes {
    title: string;
    description: string;
    discount: number;
    createdAt: string;
}

interface OfferMeta {
    isClaimed: boolean;
}

interface OfferCardProps {
    type: string;
    id: string;
    attributes: OfferAttributes;
    meta: OfferMeta;
}

export const OfferCard: React.FC<OfferCardProps> = ({ type, id, attributes, meta }) => {
    return (
        <div>
            <h3>{attributes.title}</h3>
            <p>{attributes.description}</p>
            <div>
                <span>Descuento: {attributes.discount}%</span>
                <span>Fecha: {new Date(attributes.createdAt).toLocaleDateString()}</span>
            </div>
            <div>{meta.isClaimed ? <span>Reclamada</span> : <button>Reclamar oferta</button>}</div>
        </div>
    );
};
