import { useAuth } from '@/contexts/AuthContext';
import { JSX } from 'react';
import { Navigate } from 'react-router-dom';

export const AuthGuard = ({ children }: { children: JSX.Element }) => {
    const { isAuthenticated } = useAuth();
    return isAuthenticated ? children : <Navigate to="/login" replace />;
};

export const GuestGuard = ({ children }: { children: JSX.Element }) => {
    const { isAuthenticated } = useAuth();
    return !isAuthenticated ? children : <Navigate to="/offers" replace />;
};
