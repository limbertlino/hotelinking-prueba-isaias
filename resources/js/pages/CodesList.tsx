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
            <p>Codigos</p>
            {codes.data.codes.map((code) => {
                return <CodeCard key={code.id} code={code} />;
            })}
        </>
    );
}
