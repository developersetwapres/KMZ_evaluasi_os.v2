import { InertiaLinkProps } from '@inertiajs/react';
import { LucideIcon } from 'lucide-react';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon | null;
    isActive?: boolean;
}

export interface SharedData {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
    [key: string]: unknown;
}

export interface User {
    id: number;
    email: string;
    email_verified_at: string | null;
    userable: Pegawai | Outsourcing;
    role: string;
    two_factor_enabled?: boolean;
    created_at: string;
    updated_at: string;
    [key: string]: unknown; // This allows for additional properties...
}

export interface Pegawai {
    id: number;
    name: string;
    jabatan: string;
    image: string;
    avatar: string | null;
    [key: string]: unknown;
}

export interface Outsourcing {
    uuid: string;
    name: string;
    image: string;
    nrp_os: string;
    jabatan_id: number;
    jabatan: Jabatan;
    unit_kerja: string;
    status: string;
    [key: string]: unknown;
}

export interface Jabatan {
    id: number;
    nama_jabatan: string;
    kode_jabatan: string;
    [key: string]: unknown;
}

export interface PenugasanPenilai {
    id: number;
    siklus_id: number;

    outsourcing_id: number;
    outsourcing: Outsourcing;
    penilai_id: number;
    penilai: User;

    tipe_penilai: 'atasan' | 'user' | 'teman';
    bobot_penilai: number;
    status: 'pending' | 'aktif' | 'nonaktif';
    catatan: string | null;
    [key: string]: unknown;
}

export interface PenugasanPeer {
    uuid: string;
    name: string;
    image: string;
    nrp_os: string;
    jabatan_id: number;
    nama_jabatan: string;
    unit_kerja: string;
    status: string;

    evaluators: {
        atasan: {
            name: string | null;
            jabatan: string | null;
        };
        penerima_layanan: {
            name: string | null;
            jabatan: string | null;
        };
        teman: {
            name: string | null;
            jabatan: string | null;
        };
    };
}
