import { createBrowserRouter } from 'react-router-dom';
import { Login } from '@/pages';
import { GuestLayout } from '@/pages/layouts';

export const router = createBrowserRouter([
  {
    path: '/',
    element: <GuestLayout />,
    children: [
      {
        path: '/login',
        element: <Login />,
      },
      {
        path: '/register',
        element: <h1>Home</h1>,
      },
    ],
  },
  {
    path: '/login',
    element: <Login />,
  },
  {
    path: '/',
    element: <h1>Home</h1>,
  },
]);
