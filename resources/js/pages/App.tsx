import { AuthProvider } from '@/AuthContext';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import CodesList from './CodesList';
import Layout from './Layout';
import { LoginForm } from './LoginForm';
import OffersList from './OffersList';
import RegisterForm from './RegisterForm';

export default function App() {
    return (
        <AuthProvider>
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Layout />}>
                        <Route index element={<RegisterForm />} />
                        <Route path="login" element={<LoginForm />} />
                        <Route path="register" element={<RegisterForm />} />
                        <Route path="codes" element={<CodesList />} />
                        <Route path="offers" element={<OffersList />} />
                    </Route>
                </Routes>
            </BrowserRouter>
        </AuthProvider>
    );
}
