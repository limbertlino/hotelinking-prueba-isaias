interface CodeCardProps {
    code: {
        type: string;
        id: string;
        attributes: {
            code: string;
            status: string;
            redeemedAt: string | null;
            createdAt: string;
        };
        meta: {
            isRedeemed: boolean;
        };
        relationships: {
            user: {
                data: {
                    type: string;
                    id: string;
                };
            };
            offer: {
                data: {
                    type: string;
                    id: string;
                    attributes: {
                        title: string;
                        description: string;
                        discount: number;
                    };
                };
            };
        };
    };
    onRedeem?: (id: string) => void;
}

export default function CodeCard({ code, onRedeem }: CodeCardProps) {
    return (
        <>
            <div className="w-80 rounded-lg border bg-white p-4 shadow-lg">
                <div className="rounded-md bg-gray-100 p-3 text-center">
                    <h3 className="text-2xl font-bold text-gray-900">{code.attributes.code}</h3>
                </div>
                <div className="mt-2">
                    <p className="text-gray-500">Oferta</p>
                    <p className="font-medium text-gray-800">{code.relationships.offer.data.attributes.title}</p>
                </div>
                <div className="mt-2 flex items-center justify-between">
                    <p className="text-gray-500">Descuento</p>
                    <p className="text-lg font-bold text-gray-900">{code.relationships.offer.data.attributes.discount}%</p>
                </div>
                <button
                    onClick={() => onRedeem?.(code.id)}
                    disabled={code.meta?.isRedeemed}
                    className={`mt-4 w-full rounded-md py-2 font-bold text-white transition ${
                        code.attributes?.redeemedAt ? 'cursor-not-allowed bg-gray-400' : 'bg-blue-600 hover:bg-blue-700'
                    }`}
                >
                    {code.attributes?.redeemedAt ? 'Codigo Canjeado' : 'Canjear'}
                </button>
            </div>
        </>
    );
}
