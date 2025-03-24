import { Link, Outlet } from 'react-router-dom';

export default function Layout() {
    const isLoggedIn = !!localStorage.getItem('authToken');

    const handleLogout = () => {
        localStorage.removeItem('authToken');
        window.location.href = '/login';
    };

    return (
        <div>
            <header
                style={{
                    background: '#333',
                    color: 'white',
                    padding: '1rem',
                    display: 'flex',
                    gap: '1rem',
                }}
            >
                <h1>My App</h1>
                <nav>
                    {isLoggedIn ? (
                        <>
                            <Link to="/codes" style={{ color: 'white', marginRight: '1rem' }}>
                                Mis Códigos
                            </Link>
                            <button onClick={handleLogout}>Logout</button>
                        </>
                    ) : (
                        <>
                            <Link to="/login" style={{ color: 'white', marginRight: '1rem' }}>
                                Login
                            </Link>
                            <Link to="/register" style={{ color: 'white', marginRight: '1rem' }}>
                                Register
                            </Link>
                        </>
                    )}
                </nav>
            </header>

            <main style={{ padding: '1rem' }}>
                <Outlet />
            </main>
        </div>
    );
}
