export interface JSONAPIResponse<T = unknown> {
    data: {
        type: string;
        id?: string;
        attributes: T;
        relationships?: Record<string, any>;
    };
    included?: Array<any>;
    meta?: Record<string, any>;
}

export interface TokenAttributes {
    token: string;
}

export interface UserAttributes {
    email: string;
}

export interface AuthResponse {
    data: {
        user: {
            type: string;
            attributes: UserAttributes;
        };
        token: {
            type: string;
            attributes: TokenAttributes;
        };
    };
    status: number;
    message: string;
}
