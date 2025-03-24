import api from '@/api';
import { useEffect, useState } from 'react';

export default function CodesList() {
    const [codes, setCodes] = useState([]);

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

    return <></>;
}
