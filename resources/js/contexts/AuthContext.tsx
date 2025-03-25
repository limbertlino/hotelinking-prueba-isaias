import { createContext, useContext, useState } from 'react';

/**
 * Type for the authentication context.
 *
 * @typedef {Object} AuthContextType
 * @property {boolean} isAuthenticated - Indicates whether the user is authenticated.
 * @property {(token: string) => void} login - Function to authenticate the user.
 * @property {() => void} logout - Function to log the user out.
 */
type AuthContextType = {
    isAuthenticated: boolean;
    login: (token: string) => void;
    logout: () => void;
};

// Create context with default values
const AuthContext = createContext<AuthContextType>({
    isAuthenticated: false,
    login: () => {},
    logout: () => {},
});

/**
 * AuthProvider component that manages the authentication state.
 *
 * This component provides the authentication context to its children.
 *
 * @param {Object} props - The component props.
 * @param {React.ReactNode} props.children - The children to be rendered within the provider.
 * @returns {JSX.Element} The AuthContext.Provider wrapped around children.
 */

export const AuthProvider = ({ children }: { children: React.ReactNode }) => {
    const [isAuthenticated, setIsAuthenticated] = useState(!!localStorage.getItem('authToken'));

    /**
     * Logs the user in by setting the auth token in localStorage and updating the authentication state.
     *
     * @param {string} token - The authentication token.
     */
    const login = (token: string) => {
        localStorage.setItem('authToken', token);
        setIsAuthenticated(true);
    };

    /**
     * Logs the user out by removing the auth token from localStorage and updating the authentication state.
     */
    const logout = () => {
        localStorage.removeItem('authToken');
        setIsAuthenticated(false);
    };

    return <AuthContext.Provider value={{ isAuthenticated, login, logout }}>{children}</AuthContext.Provider>;
};

export const useAuth = () => useContext(AuthContext);
