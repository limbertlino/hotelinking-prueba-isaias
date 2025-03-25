import api from '@/api';
import { CodesResponse } from '@/types/codes';
import { useEffect, useState } from 'react';

export default function CodesList() {
    const [codes, setCodes] = useState<CodesResponse | null>(null);

    useEffect(() => {
        const fetchCodes = async () => {
            try {
                const response = await api.get('/users/codes');
                let data = response.data;
                console.log(data);
                setCodes(response.data);
            } catch (error) {
                console.error('Error fetching codes:', error);
            }
        };

        fetchCodes();
    }, []);

    if (!codes) {
        return <div>Cargando codigos...</div>;
    }

    return (
        <>
            <p>Codigos</p>
            {codes.data.codes.map((code) => (
                <div key={code.id}>
                    <h1>{code.attributes.code}</h1>
                    <p></p>
                </div>
            ))}
        </>
    );
}
