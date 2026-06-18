import { Toaster } from '@/components/ui/toaster';
import type React from 'react';

export default function EvaluatorLayout({
    children,
}: {
    children: React.ReactNode;
}) {
    return (
        <>
            {children}
            <Toaster />
        </>
    );
}
