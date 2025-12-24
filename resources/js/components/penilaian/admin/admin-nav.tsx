'use client';

import { index as indexPenugasan } from '@/actions/App/Http/Controllers/PenugasanPenilaiController';
import { cn } from '@/lib/utils';
import { dashboard } from '@/routes';
import { ranking } from '@/routes/os';
import { index as userIndex } from '@/routes/user';
import { Link, usePage } from '@inertiajs/react';
import { BarChart3, UserCog, Users } from 'lucide-react';

const navItems = [
    {
        href: dashboard.url(),
        label: 'Rekap Hasil',
        icon: BarChart3,
    },
    {
        href: ranking.url(),
        label: 'Ranking Skor',
        icon: BarChart3,
    },
    {
        href: indexPenugasan.url(),
        label: 'Penugasan Peer',
        icon: Users,
    },
    // {
    //     href: '/admin/evaluasi-360',
    //     label: 'Evaluasi 360',
    //     icon: Settings,
    // },
    {
        href: userIndex.url(),
        label: 'Kelola User',
        icon: UserCog,
    },
];

export function AdminNav() {
    const { url } = usePage();

    return (
        <nav
            className={`grid h-12 w-full grid-cols-${navItems.length} rounded-lg bg-muted p-1`}
        >
            {navItems.map((item) => {
                const Icon = item.icon;
                const pathname = url; // mirip usePathname()
                const isActive = pathname === item.href;

                return (
                    <Link
                        href={item.href}
                        key={item.href}
                        className={cn(
                            'flex items-center justify-center space-x-2 rounded-md px-3 py-2 text-sm font-medium transition-all',
                            isActive
                                ? 'bg-background text-foreground shadow-sm'
                                : 'text-muted-foreground hover:bg-background/50 hover:text-foreground',
                        )}
                    >
                        <Icon className="h-4 w-4" />
                        <span className="hidden sm:inline">{item.label}</span>
                    </Link>
                );
            })}
        </nav>
    );
}
