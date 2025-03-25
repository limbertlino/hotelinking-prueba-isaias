import CodeCard from '@/components/CodeCard';
import { fetchUserCodes } from '@/services/codeService';
import { CodesResponse } from '@/types/codes';
import { useEffect, useState } from 'react';

export default function CodesList() {
    const [codes, setCodes] = useState<CodesResponse | null>(null);

    useEffect(() => {
        const loadCodes = async () => {
            try {
                const data = await fetchUserCodes();
                setCodes(data);
            } catch (error) {
                console.error('Error fetching codes:', error);
            }
        };

        loadCodes();
    }, []);

    if (!codes) {
        return <div>Cargando codigos...</div>;
    }

    return (
        <>
            <div className="container mx-auto p-4">
                <h2 className="mb-4 text-center text-xl font-bold">Códigos</h2>
                <div className="grid grid-cols-1 place-items-center gap-6 sm:grid-cols-2 md:grid-cols-2">
                    {codes.data.codes.map((code) => (
                        <CodeCard key={code.id} code={code} />
                    ))}
                </div>
            </div>
        </>
    );
}
