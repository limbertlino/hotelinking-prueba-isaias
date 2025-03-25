export interface CodeAttributes {
    code: string;
    status: 'active' | 'inactive' | 'expired';
    redeemedAt: string | null;
    createdAt: string;
}

export interface CodeMeta {
    isRedeemed: boolean;
}

export interface Code {
    type: string;
    id: string;
    attributes: CodeAttributes;
    meta: CodeMeta;
    relationships: {
        user: {
            data: {
                type: 'users';
                id: string;
            };
        };
        offer: {
            data: {
                type: 'offers';
                id: string;
            };
        };
    };
}

export interface CodesResponse {
    message: string;
    data: {
        codes: Code[];
    };
    status: number;
}
