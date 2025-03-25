import { AuthGuard, GuestGuard } from '@/components/AuthGuard';
import { AuthProvider } from '@/contexts/AuthContext';
import { BrowserRouter, Outlet, Route, Routes } from 'react-router-dom';
import Layout from '../layouts/MainLayout';
import CodesList from './CodesList';
import OffersList from './OffersList';
import LoginPage from './auth/LoginPage';
import RegisterPage from './auth/RegisterPage';

export default function App() {
    return (
        <AuthProvider>
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Layout />}>
                        <Route
                            element={
                                <GuestGuard>
                                    <Outlet />
                                </GuestGuard>
                            }
                        >
                            <Route index element={<RegisterPage />} />
                            <Route path="login" element={<LoginPage />} />
                            <Route path="register" element={<RegisterPage />} />
                        </Route>

                        <Route
                            element={
                                <AuthGuard>
                                    <Outlet />
                                </AuthGuard>
                            }
                        >
                            <Route path="codes" element={<CodesList />} />
                            <Route path="offers" element={<OffersList />} />
                        </Route>
                    </Route>
                </Routes>
            </BrowserRouter>
        </AuthProvider>
    );
}
