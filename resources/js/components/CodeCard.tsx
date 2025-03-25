interface CodeCardProps {
    code: {
        id: string;
        attributes: {
            code: string;
        };
        relationships: {
            offer: {
                data: {
                    attributes: {
                        title: string;
                        discount: number;
                    };
                };
            };
        };
    };
}

export default function CodeCard({ code }: CodeCardProps) {
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
            </div>
        </>
    );
}
