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
        <div key={code.id}>
            <h3>{code.attributes.code}</h3>
            <p>Oferta: {code.relationships.offer.data.attributes.title}</p>
            <p>Descuento: {code.relationships.offer.data.attributes.discount}%</p>
        </div>
    );
}
