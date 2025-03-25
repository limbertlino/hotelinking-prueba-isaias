export interface OfferAttributes {
    title: string;
    description: string;
    discount: number;
    createdAt: string;
}

export interface OfferMeta {
    isClaimed: boolean;
}

export interface Offer {
    type: string;
    id: string;
    attributes: OfferAttributes;
    meta: OfferMeta;
}

export interface OffersResponse {
    message: string;
    data: {
        offers: Offer[];
    };
    status: number;
}