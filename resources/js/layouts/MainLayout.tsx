import { useAuth } from '@/contexts/AuthContext';
import { Link, Outlet, useNavigate } from 'react-router-dom';

export default function Layout() {
    const { isAuthenticated, logout } = useAuth();
    const navigate = useNavigate();

    const handleLogout = () => {
        logout();
        navigate('/login');
    };

    return (
        <div className="flex min-h-screen flex-col font-sans">
            <header className="bg-gray-800 text-white">
                <div className="container mx-auto flex items-center justify-between px-4 py-3">
                    <h1 className="text-xl font-bold">My App</h1>

                    <nav className="flex items-center space-x-4">
                        {isAuthenticated ? (
                            <>
                                <Link to="/offers" className="transition-colors hover:text-gray-300">
                                    Mis Ofertas
                                </Link>
                                <Link to="/codes" className="transition-colors hover:text-gray-300">
                                    Mis Códigos
                                </Link>
                                <button onClick={handleLogout} className="rounded bg-red-600 px-3 py-1 transition-colors hover:bg-red-700">
                                    Logout
                                </button>
                            </>
                        ) : (
                            <>
                                <Link to="/login" className="transition-colors hover:text-gray-300">
                                    Login
                                </Link>
                                <Link to="/register" className="rounded bg-blue-600 px-3 py-1 transition-colors hover:bg-blue-700">
                                    Register
                                </Link>
                            </>
                        )}
                    </nav>
                </div>
            </header>

            <main className="container mx-auto max-w-4xl flex-grow px-4 py-6">
                <Outlet />
            </main>
        </div>
    );
}
