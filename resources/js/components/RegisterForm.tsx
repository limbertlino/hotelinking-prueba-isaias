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
        <form onSubmit={handleSubmit(onSubmit)}>
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
        </form>
    );
}
