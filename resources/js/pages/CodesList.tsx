import CodeCard from '@/components/CodeCard';
import { fetchUserCodes, redeemUserCode } from '@/services/codeService';
import { CodesResponse } from '@/types/codes';
import { produce } from 'immer';
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

    const redeemCode = async (id: string) => {
        try {
            setCodes(
                produce((draft) => {
                    const code = draft?.data?.codes.find((c) => c.id === id);
                    console.log(code);
                    if (code) code.attributes.redeemedAt = new Date().toISOString();
                }),
            );
            await redeemUserCode(id);
        } catch (error) {
            setCodes(
                produce((draft) => {
                    const code = draft?.data?.codes.find((c) => c.id === id);
                    console.log(code);
                    if (code) code.attributes.redeemedAt = null;
                }),
            );
            console.error('Redeemed error', error);
        }
    };

    return (
        <>
            <div className="container mx-auto p-4">
                <h2 className="mb-4 text-center text-xl font-bold">Códigos</h2>
                <div className="grid grid-cols-1 place-items-center gap-6 sm:grid-cols-2 md:grid-cols-2">
                    {codes.data.codes.map((code) => (
                        <CodeCard key={code.id} code={code} onRedeem={redeemCode} />
                    ))}
                </div>
            </div>
        </>
    );
}
