import { registerUser } from '@/services/authService';
import { useForm } from 'react-hook-form';
import { useNavigate } from 'react-router-dom';

type FormData = {
    email: string;
    password: string;
    confirmPassword: string;
};

export default function RegisterForm() {
    const navigate = useNavigate();
    const {
        register,
        handleSubmit,
        formState: { errors },
        watch,
    } = useForm<FormData>();

    const onSubmit = async (data: FormData) => {
        try {
            await registerUser(data.email, data.password);
            navigate('/login');
        } catch (error) {
            console.error('Error en el registro:', error);
        }
    };

    return (
        <>
            <div className="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
                <div className="sm:mx-auto sm:w-full sm:max-w-sm">
                    <h2 className="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Registrate</h2>
                </div>

                <div className="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form onSubmit={handleSubmit(onSubmit)} className="space-y-6">
                        <div>
                            <label htmlFor="email" className="block text-sm/6 font-medium text-gray-900">
                                Email
                            </label>
                            <div className="mt-2">
                                <input
                                    autoComplete="email"
                                    id="email"
                                    type="email"
                                    required
                                    {...register('email', {
                                        required: 'Email es requerido',
                                        pattern: {
                                            value: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                            message: 'Email inválido',
                                        },
                                    })}
                                    className="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                />
                                {errors.email && <span>{errors.email.message}</span>}
                            </div>
                        </div>

                        <div>
                            <div className="flex items-center justify-between">
                                <label htmlFor="password" className="block text-sm/6 font-medium text-gray-900">
                                    Contraseña
                                </label>
                            </div>
                            <div className="mt-2">
                                <input
                                    autoComplete="current-password"
                                    type="password"
                                    id="password"
                                    required
                                    {...register('password', {
                                        required: 'Password es requerido',
                                        minLength: {
                                            value: 6,
                                            message: 'Mínimo 6 caracteres',
                                        },
                                    })}
                                    className="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                />

                                {errors.password && <span>{errors.password.message}</span>}
                            </div>
                        </div>

                        <div>
                            <div className="flex items-center justify-between">
                                <label htmlFor="passwordConfirm" className="block text-sm/6 font-medium text-gray-900">
                                    Confirmar Contraseña
                                </label>
                            </div>
                            <div className="mt-2">
                                <input
                                    autoComplete="current-password"
                                    type="password"
                                    id="passwordConfirm"
                                    required
                                    {...register('confirmPassword', {
                                        validate: (value) => value === watch('password') || 'Las contraseñas no coinciden',
                                    })}
                                    className="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                />

                                {errors.confirmPassword && <span>{errors.confirmPassword.message}</span>}
                            </div>
                        </div>

                        <div>
                            <button
                                type="submit"
                                className="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            >
                                Registrarse
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {/* <form onSubmit={handleSubmit(onSubmit)}>
                <div>
                    <label>Email</label>
                    <input
                        type="email"
                        {...register('email', {
                            required: 'Email es requerido',
                            pattern: {
                                value: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: 'Email inválido',
                            },
                        })}
                    />
                    {errors.email && <span>{errors.email.message}</span>}
                </div>

                <div>
                    <label>Password</label>
                    <input
                        type="password"
                        {...register('password', {
                            required: 'Password es requerido',
                            minLength: {
                                value: 6,
                                message: 'Mínimo 6 caracteres',
                            },
                        })}
                    />
                    {errors.password && <span>{errors.password.message}</span>}
                </div>

                <div>
                    <label>Confirmar Password</label>
                    <input
                        type="password"
                        {...register('confirmPassword', {
                            validate: (value) => value === watch('password') || 'Las contraseñas no coinciden',
                        })}
                    />
                    {errors.confirmPassword && <span>{errors.confirmPassword.message}</span>}
                </div>

                <button type="submit">Registrarse</button>
            </form> */}
        </>
    );
}
