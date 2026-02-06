'use client';

import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from '@/components/ui/accordion';
import { Badge } from '@/components/ui/badge';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { useMobileNavigation } from '@/hooks/use-mobile-navigation';
import { useToast } from '@/hooks/use-toast';
import { logout } from '@/routes';
import { create } from '@/routes/penilaian';
import { SharedData } from '@/types';
import { Head, Link, router, usePage } from '@inertiajs/react';
import {
    Award,
    Briefcase,
    Calendar,
    CheckCircle,
    ClipboardList,
    Clock,
    History,
    LogOut,
    MessageCircle,
    User,
    Users,
} from 'lucide-react';

const semesterHistory = [
    {
        id: 'sem-2024-2',
        name: 'Semester Genap 2024/2025',
        period: 'Februari - Juli 2025',
        status: 'completed',
        employees: [
            {
                id: 1,
                uuid: 'uuid-1',
                outsourcings: {
                    name: 'Ahmad Fauzi',
                    jabatan: 'IT Support',
                    image: 'placeholder-user.jpg',
                },
                status: 'completed',
                tipe_penilai: 'atasan_langsung',
                score: 88,
            },
            {
                id: 2,
                uuid: 'uuid-2',
                outsourcings: {
                    name: 'Siti Nurhaliza',
                    jabatan: 'Admin',
                    image: 'placeholder-user.jpg',
                },
                status: 'completed',
                tipe_penilai: 'peer',
                score: 92,
            },
        ],
    },
    {
        id: 'sem-2024-1',
        name: 'Semester Ganjil 2024/2025',
        period: 'Agustus 2024 - Januari 2025',
        status: 'completed',
        employees: [
            {
                id: 3,
                uuid: 'uuid-3',
                outsourcings: {
                    name: 'Budi Santoso',
                    jabatan: 'Security',
                    image: 'placeholder-user.jpg',
                },
                status: 'completed',
                tipe_penilai: 'atasan_langsung',
                score: 85,
            },
            {
                id: 4,
                uuid: 'uuid-4',
                outsourcings: {
                    name: 'Lisa Permata',
                    jabatan: 'Receptionist',
                    image: 'placeholder-user.jpg',
                },
                status: 'completed',
                tipe_penilai: 'peer',
                score: 90,
            },
        ],
    },
];

export default function EvaluatorPage({ penugasanPeer, semesterHistory }: any) {
    const { auth } = usePage<SharedData>().props;
    const user = auth.user;

    const { toast } = useToast();

    const cleanup = useMobileNavigation();

    const handleLogout = () => {
        cleanup();
        router.flushAll();
    };

    console.log(user);

    return (
        <>
            <Head title="Evaluator" />
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
                {/* Header */}
                <header className="border-b bg-white shadow-sm">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div className="flex items-center justify-between py-4">
                            <div className="flex items-center space-x-3">
                                <div className="rounded-lg bg-indigo-600 p-2">
                                    <ClipboardList className="h-6 w-6 text-white" />
                                </div>
                                <div>
                                    <h1 className="text-xl font-bold text-gray-900">
                                        Penilaian Outsourcing
                                    </h1>
                                    <p className="flex items-center gap-2 text-sm text-gray-500">
                                        <Calendar className="h-4 w-4 text-gray-400" />
                                        Semester 2025/2026 Genap
                                    </p>
                                </div>
                            </div>

                            <Link
                                className="inline-flex items-center justify-center gap-2 space-x-2 rounded-md border bg-transparent px-3 py-2 text-sm font-medium whitespace-nowrap hover:border-red-200 hover:bg-red-50 hover:text-red-600"
                                href={logout()}
                                onClick={handleLogout}
                                data-test="logout-button"
                            >
                                <LogOut className="h-4 w-4" />
                                Log out
                            </Link>
                        </div>
                    </div>
                </header>

                <main className="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                    <div className="space-y-8">
                        {/* User Profile Card - Simplified */}
                        <Card className="bg-gradient-to-r from-green-500 to-green-600 py-5 text-white">
                            <CardHeader>
                                <div className="flex items-center space-x-4">
                                    <div className="rounded-full bg-white/20 p-3">
                                        <img
                                            src={`/storage/${user?.userable?.image}`}
                                            alt={user?.userable?.name}
                                            className="h-17 w-17 rounded-full"
                                        />
                                    </div>
                                    <div>
                                        <CardTitle className="text-2xl text-white">
                                            {user?.userable?.name}
                                        </CardTitle>
                                        <CardDescription className="text-green-100">
                                            {user?.is_ldap == '0'
                                                ? user?.userable?.jabatan
                                                      ?.nama_jabatan
                                                : user?.userable?.jabatan}
                                            {' • '}
                                            {user?.userable?.biro?.nama_biro}
                                        </CardDescription>
                                    </div>
                                </div>
                            </CardHeader>
                        </Card>

                        <Tabs className="space-y-6" defaultValue={'current'}>
                            <TabsList className="w-full gap-1.5 bg-white shadow-md">
                                <TabsTrigger
                                    value="current"
                                    className="flex w-full items-center gap-2 rounded-md border bg-gray-100 text-slate-700 transition-all data-[state=active]:border-blue-600 data-[state=active]:bg-gradient-to-r data-[state=active]:from-blue-500 data-[state=active]:to-indigo-600 data-[state=active]:text-white data-[state=inactive]:hover:bg-gradient-to-r data-[state=inactive]:hover:from-gray-300 data-[state=inactive]:hover:to-gray-500 data-[state=inactive]:hover:text-white"
                                >
                                    <Calendar className="h-4 w-4" />
                                    Semester Aktif
                                </TabsTrigger>

                                <TabsTrigger
                                    value="history"
                                    className="flex w-full items-center gap-2 rounded-md border bg-gray-100 text-slate-700 transition-all data-[state=active]:border-blue-600 data-[state=active]:bg-gradient-to-r data-[state=active]:from-blue-500 data-[state=active]:to-indigo-600 data-[state=active]:text-white data-[state=inactive]:hover:bg-gradient-to-r data-[state=inactive]:hover:from-gray-300 data-[state=inactive]:hover:to-gray-500 data-[state=inactive]:hover:text-white"
                                >
                                    <History className="h-4 w-4" />
                                    Riwayat Semester
                                </TabsTrigger>
                            </TabsList>

                            {/* Current Semester Tab */}
                            <TabsContent value="current" className="space-y-6">
                                <Card className="border-0 bg-linear-to-br from-blue-50 shadow-md">
                                    <CardContent>
                                        <div className="flex items-center justify-between">
                                            <div className="flex items-center gap-3">
                                                <div className="rounded-lg bg-gray-100 p-2">
                                                    <Users className="h-5 w-5 text-gray-600" />
                                                </div>
                                                <div>
                                                    <h3 className="text-lg font-bold text-gray-900">
                                                        Nilai Saya — Semester
                                                        Aktif
                                                    </h3>
                                                    <p className="text-sm text-gray-500">
                                                        Ringkasan penilaian
                                                        pribadi pada semester
                                                        berjalan
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div className="mt-4 grid gap-2 md:grid-cols-3">
                                            <Card className="p-4">
                                                <div className="flex items-start justify-between">
                                                    <div className="flex items-center gap-2">
                                                        <div className="rounded-md bg-indigo-50 p-2">
                                                            <Briefcase className="h-5 w-5 text-indigo-600" />
                                                        </div>
                                                        <div>
                                                            <h4 className="text-sm font-semibold text-gray-900">
                                                                Atasan
                                                            </h4>
                                                            <p className="text-xs text-gray-500">
                                                                Penilaian oleh
                                                                atasan langsung
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <Badge className="bg-green-100 text-green-800">
                                                        Selesai
                                                    </Badge>
                                                </div>

                                                <div className="text-center text-4xl font-bold text-gray-900">
                                                    88
                                                </div>

                                                <div className="text-center text-sm text-gray-600">
                                                    "Kerja sangat baik, terus
                                                    pertahankan kualitas
                                                    layanan."
                                                </div>
                                            </Card>

                                            <Card className="p-4">
                                                <div className="flex items-start justify-between">
                                                    <div className="flex items-center gap-3">
                                                        <div className="rounded-md bg-green-50 p-2">
                                                            <Users className="h-5 w-5 text-green-600" />
                                                        </div>
                                                        <div>
                                                            <h4 className="text-sm font-semibold text-gray-900">
                                                                Penerima Layanan
                                                            </h4>
                                                            <p className="text-xs text-gray-500">
                                                                Penilaian oleh
                                                                penerima layanan
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <Badge className="bg-yellow-100 text-yellow-800">
                                                        Sedang Dinilai
                                                    </Badge>
                                                </div>

                                                <div className="mt-4 flex items-center justify-between">
                                                    <div>
                                                        <div className="text-3xl font-bold text-gray-900">
                                                            -
                                                        </div>
                                                        <div className="text-xs text-gray-500">
                                                            Belum tersedia
                                                        </div>
                                                    </div>
                                                    <div className="text-right text-sm text-gray-600">
                                                        "Belum ada feedback"
                                                    </div>
                                                </div>
                                            </Card>

                                            <Card className="p-4">
                                                <div className="flex items-start justify-between">
                                                    <div className="flex items-center gap-3">
                                                        <div className="rounded-md bg-blue-50 p-2">
                                                            <MessageCircle className="h-5 w-5 text-blue-600" />
                                                        </div>
                                                        <div>
                                                            <h4 className="text-sm font-semibold text-gray-900">
                                                                Rekan / Teman
                                                                Kerja
                                                            </h4>
                                                            <p className="text-xs text-gray-500">
                                                                Penilaian oleh
                                                                rekan kerja
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <Badge className="bg-gray-100 text-gray-800">
                                                        Belum Dinilai
                                                    </Badge>
                                                </div>

                                                <div className="mt-4 flex items-center justify-between">
                                                    <div>
                                                        <div className="text-3xl font-bold text-gray-900">
                                                            -
                                                        </div>
                                                        <div className="text-xs text-gray-500">
                                                            Belum tersedia
                                                        </div>
                                                    </div>
                                                    <div className="text-right text-sm text-gray-600">
                                                        "Belum ada feedback"
                                                    </div>
                                                </div>
                                            </Card>
                                        </div>
                                    </CardContent>
                                </Card>

                                <Card className="border-0 bg-linear-to-br from-blue-50 shadow-md">
                                    <CardContent>
                                        <div className="mb-6 flex items-center justify-between">
                                            <div className="flex items-center gap-3">
                                                <div className="rounded-lg bg-gray-100 p-2">
                                                    <Users className="h-5 w-5 text-gray-600" />
                                                </div>
                                                <div>
                                                    <h3 className="text-lg font-bold text-gray-900">
                                                        Daftar Pegawai yang
                                                        Dinilai
                                                    </h3>
                                                    <p className="text-sm text-gray-500">
                                                        Pegawai outsourcing yang
                                                        harus dinilai
                                                    </p>
                                                </div>
                                            </div>

                                            <div className="flex items-center gap-4">
                                                <div className="rounded-lg bg-white px-4 py-2 shadow-md">
                                                    <div className="text-center">
                                                        <div className="text-2xl font-bold text-blue-600">
                                                            {
                                                                penugasanPeer?.length
                                                            }
                                                        </div>
                                                        <div className="text-xs text-gray-500">
                                                            Total
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="rounded-lg bg-white px-4 py-2 shadow-md">
                                                    <div className="text-center">
                                                        <div className="text-2xl font-bold text-green-600">
                                                            {
                                                                penugasanPeer?.filter(
                                                                    (
                                                                        emp: any,
                                                                    ) =>
                                                                        emp.status ===
                                                                        'completed',
                                                                ).length
                                                            }
                                                        </div>
                                                        <div className="text-xs text-gray-500">
                                                            Selesai
                                                        </div>
                                                    </div>
                                                </div>
                                                {/* NANTI KETIKA SUDAH DIBUAT SAVE PENDING */}
                                                {/* <div className="rounded-lg bg-white px-4 py-2 shadow-md">
                                                        <div className="text-center">
                                                            <div className="text-2xl font-bold text-orange-600">
                                                                {penugasanPeer.pending}
                                                            </div>
                                                            <div className="text-xs text-gray-500">
                                                                Pending
                                                            </div>
                                                        </div>
                                                    </div> */}
                                            </div>
                                        </div>

                                        {/* Creative Employee Cards */}
                                        <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                            {penugasanPeer?.map(
                                                (employee: any) => (
                                                    <Card
                                                        key={employee.id}
                                                        className="group relative overflow-hidden border-0 bg-gradient-to-br from-white to-blue-50 pb-2 shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                                                    >
                                                        {/* Status Badge - Floating */}
                                                        <div className="absolute top-4 right-4 z-10">
                                                            <Badge
                                                                variant={
                                                                    employee.status ===
                                                                    'completed'
                                                                        ? 'default'
                                                                        : 'secondary'
                                                                }
                                                                className={`flex items-center space-x-1 px-3 py-1 shadow-lg ${
                                                                    employee.status ===
                                                                    'completed'
                                                                        ? 'bg-green-500 text-white hover:bg-green-600'
                                                                        : 'bg-orange-500 text-white hover:bg-orange-600'
                                                                }`}
                                                            >
                                                                {employee.status ===
                                                                'completed' ? (
                                                                    <CheckCircle className="h-3 w-3" />
                                                                ) : (
                                                                    <Clock className="h-3 w-3" />
                                                                )}
                                                                <span className="text-xs font-medium">
                                                                    {employee.status ==
                                                                    'completed'
                                                                        ? 'Selesai'
                                                                        : 'Belum'}
                                                                </span>
                                                            </Badge>
                                                        </div>

                                                        {/* Decorative Background Pattern */}
                                                        <div className="absolute inset-0 opacity-5">
                                                            <div className="absolute top-0 right-0 h-32 w-32 translate-x-16 -translate-y-16 rounded-full bg-blue-500"></div>
                                                            <div className="absolute bottom-0 left-0 h-24 w-24 -translate-x-12 translate-y-12 rounded-full bg-indigo-500"></div>
                                                        </div>

                                                        <CardContent className="relative z-10 p-8 text-center">
                                                            {/* Photo with Decorative Ring */}
                                                            <div className="relative mb-4">
                                                                <img
                                                                    src={
                                                                        `/storage/${employee.outsourcings.image}` ||
                                                                        '/placeholder.svg'
                                                                    }
                                                                    alt={
                                                                        employee
                                                                            .outsourcings
                                                                            .name
                                                                    }
                                                                    className="mx-auto h-27 w-27 rounded-full border-4 border-white shadow-md transition-transform duration-300 group-hover:scale-110"
                                                                />
                                                            </div>

                                                            <h3 className="mb-1 overflow-hidden bg-gradient-to-r from-gray-800 to-blue-600 bg-clip-text text-xl font-bold text-ellipsis whitespace-nowrap text-transparent transition-all duration-300 group-hover:from-blue-600 group-hover:to-indigo-600">
                                                                {
                                                                    employee
                                                                        .outsourcings
                                                                        .name
                                                                }
                                                            </h3>

                                                            {/* Position with Icon */}
                                                            <div className="mb-6 flex items-center justify-center space-x-2">
                                                                <p className="text-sm font-medium text-gray-600">
                                                                    {
                                                                        employee
                                                                            .outsourcings
                                                                            .jabatan
                                                                    }
                                                                </p>
                                                            </div>

                                                            <Link
                                                                href={create.url(
                                                                    employee.uuid,
                                                                )}
                                                                className={`mb-3 block w-full transform rounded-md py-2 text-sm font-semibold text-white shadow-lg transition-all duration-300 group-hover:scale-105 ${
                                                                    employee.status ===
                                                                    'completed'
                                                                        ? 'bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700'
                                                                        : 'bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700'
                                                                }`}
                                                            >
                                                                <div className="flex items-center justify-center space-x-2">
                                                                    <ClipboardList className="h-4 w-4" />
                                                                    <span>
                                                                        {employee.status ===
                                                                        'completed'
                                                                            ? 'Lihat Penilaian'
                                                                            : 'Mulai Penilaian'}
                                                                    </span>
                                                                </div>
                                                            </Link>

                                                            <span className="text-xs text-gray-600">
                                                                Nilai sebagai{' '}
                                                                {employee.tipe_penilai?.replace(
                                                                    /_/g,
                                                                    ' ',
                                                                )}
                                                            </span>
                                                        </CardContent>

                                                        {/* Hover Effect Overlay */}
                                                        <div className="pointer-events-none absolute inset-0 bg-gradient-to-t from-blue-600/10 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                                                    </Card>
                                                ),
                                            )}
                                        </div>

                                        {penugasanPeer?.length === 0 && (
                                            <Card className="border-0 bg-gradient-to-br from-gray-50 to-blue-50 py-16 text-center shadow-lg">
                                                <CardContent>
                                                    <div className="relative">
                                                        <div className="absolute inset-0 flex items-center justify-center opacity-10">
                                                            <User className="h-32 w-32 text-gray-400" />
                                                        </div>
                                                        <div className="relative z-10">
                                                            <div className="mx-auto mb-4 w-fit rounded-full bg-white p-4 shadow-lg">
                                                                <User className="h-12 w-12 text-gray-400" />
                                                            </div>
                                                            <h3 className="mb-2 text-xl font-bold text-gray-900">
                                                                {penugasanPeer?.length ===
                                                                0
                                                                    ? 'Tidak ada pegawai yang ditugaskan'
                                                                    : 'Tidak ada pegawai ditemukan'}
                                                            </h3>
                                                            <p className="mx-auto max-w-md text-gray-500">
                                                                {penugasanPeer?.length ===
                                                                0
                                                                    ? 'Hubungi administrator untuk penugasan penilaian pegawai outsourcing'
                                                                    : 'Coba ubah kata kunci pencarian Anda atau periksa filter yang digunakan'}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </CardContent>
                                            </Card>
                                        )}
                                    </CardContent>
                                </Card>
                            </TabsContent>

                            {/* History Tab */}
                            <TabsContent value="history" className="space-y-6">
                                {/* Nilai Saya - Semester Sebelumnya (personal history) */}
                                <Card className="border-0 bg-linear-to-br from-blue-50 shadow-md">
                                    <CardContent>
                                        <div className="flex items-center justify-between">
                                            <div className="flex items-center gap-3">
                                                <div className="rounded-lg bg-gray-100 p-2">
                                                    <Users className="h-5 w-5 text-gray-600" />
                                                </div>
                                                <div>
                                                    <h3 className="text-lg font-bold text-gray-900">
                                                        Nilai Saya — Semester
                                                        Sebelumnya
                                                    </h3>
                                                    <p className="text-sm text-gray-500">
                                                        Riwayat penilaian
                                                        pribadi
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div className="mt-4">
                                            <Accordion
                                                type="single"
                                                collapsible
                                                className="space-y-2"
                                            >
                                                {semesterHistory.map(
                                                    (sem: any) => (
                                                        <AccordionItem
                                                            key={sem.id}
                                                            value={sem.id}
                                                            className="border"
                                                        >
                                                            <AccordionTrigger>
                                                                <div className="flex w-full items-center justify-between">
                                                                    <div>
                                                                        <div className="font-semibold">
                                                                            {
                                                                                sem.name
                                                                            }
                                                                        </div>
                                                                        <div className="text-xs text-gray-500">
                                                                            {
                                                                                sem.period
                                                                            }
                                                                        </div>
                                                                    </div>
                                                                    <div className="text-sm text-gray-600">
                                                                        {
                                                                            sem
                                                                                .employees
                                                                                .length
                                                                        }{' '}
                                                                        pegawai
                                                                    </div>
                                                                </div>
                                                            </AccordionTrigger>

                                                            <AccordionContent>
                                                                <div className="grid gap-3">
                                                                    {[
                                                                        {
                                                                            key: 'atasan_langsung',
                                                                            title: 'Atasan',
                                                                            icon: Briefcase,
                                                                        },
                                                                        {
                                                                            key: 'penerima_layanan',
                                                                            title: 'Penerima Layanan',
                                                                            icon: Users,
                                                                        },
                                                                        {
                                                                            key: 'peer',
                                                                            title: 'Rekan',
                                                                            icon: MessageCircle,
                                                                        },
                                                                    ].map(
                                                                        (t) => {
                                                                            const found =
                                                                                sem.employees.find(
                                                                                    (
                                                                                        e: any,
                                                                                    ) =>
                                                                                        e.tipe_penilai?.includes(
                                                                                            t.key.replace(
                                                                                                '_',
                                                                                                '',
                                                                                            ),
                                                                                        ) ||
                                                                                        e.tipe_penilai?.includes(
                                                                                            t.key,
                                                                                        ),
                                                                                );
                                                                            const Icon =
                                                                                (
                                                                                    t as any
                                                                                )
                                                                                    .icon;
                                                                            return (
                                                                                <div
                                                                                    key={
                                                                                        t.key
                                                                                    }
                                                                                    className="flex items-center justify-between rounded-md border bg-white p-3"
                                                                                >
                                                                                    <div className="flex items-center gap-3">
                                                                                        <div className="rounded-md bg-gray-50 p-2">
                                                                                            <Icon className="h-4 w-4 text-gray-600" />
                                                                                        </div>
                                                                                        <div>
                                                                                            <div className="text-sm font-medium">
                                                                                                {
                                                                                                    t.title
                                                                                                }
                                                                                            </div>
                                                                                            <div className="text-xs text-gray-500">
                                                                                                {found
                                                                                                    ? found
                                                                                                          .outsourcings
                                                                                                          .name
                                                                                                    : 'Tidak ada data'}
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div className="text-right">
                                                                                        <div className="text-sm font-semibold text-purple-600">
                                                                                            {found?.score ??
                                                                                                '-'}
                                                                                        </div>
                                                                                        <div className="text-xs text-gray-500">
                                                                                            {found
                                                                                                ? 'Catatan tersedia'
                                                                                                : '—'}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            );
                                                                        },
                                                                    )}
                                                                </div>
                                                            </AccordionContent>
                                                        </AccordionItem>
                                                    ),
                                                )}
                                            </Accordion>
                                        </div>
                                    </CardContent>
                                </Card>

                                <Card className="border-0 bg-linear-to-br from-blue-50 shadow-md">
                                    <CardContent>
                                        <div className="mb-7 flex items-center justify-between">
                                            <div className="flex items-center gap-3">
                                                <div className="rounded-lg bg-gray-100 p-2">
                                                    <Users className="h-5 w-5 text-gray-600" />
                                                </div>
                                                <div>
                                                    <h3 className="text-lg font-bold text-gray-900">
                                                        Riwayat Penilaian
                                                        Semester
                                                    </h3>
                                                    <p className="text-sm text-gray-500">
                                                        Lihat hasil penilaian
                                                        dari semester sebelumnya
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        {/* Semester History Accordion */}
                                        <Accordion
                                            type="single"
                                            collapsible
                                            className="space-y-4"
                                        >
                                            {semesterHistory.map((semester) => {
                                                const semesterStats = {
                                                    total: semester.employees
                                                        .length,
                                                    completed:
                                                        semester.employees.filter(
                                                            (emp) =>
                                                                emp.status ===
                                                                'completed',
                                                        ).length,
                                                    avgScore: Math.round(
                                                        semester.employees.reduce(
                                                            (acc, emp) =>
                                                                acc +
                                                                (emp.score ||
                                                                    0),
                                                            0,
                                                        ) /
                                                            semester.employees
                                                                .length,
                                                    ),
                                                };

                                                return (
                                                    <AccordionItem
                                                        key={semester.id}
                                                        value={semester.id}
                                                        className="overflow-hidden rounded-xl border-0 bg-white shadow-md"
                                                    >
                                                        <AccordionTrigger className="px-6 py-4 hover:bg-gradient-to-r hover:from-purple-50 hover:to-indigo-50 hover:no-underline">
                                                            <div className="flex w-full items-center justify-between pr-4">
                                                                <div className="flex items-center gap-4 text-left">
                                                                    <div className="rounded-lg bg-gradient-to-br from-purple-100 to-indigo-100 p-3">
                                                                        <Calendar className="h-6 w-6 text-purple-600" />
                                                                    </div>
                                                                    <div>
                                                                        <h3 className="text-lg font-bold text-gray-900">
                                                                            {
                                                                                semester.name
                                                                            }
                                                                        </h3>
                                                                        <p className="text-sm text-gray-500">
                                                                            {
                                                                                semester.period
                                                                            }
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                {/* Mini Stats */}
                                                                <div className="hidden items-center gap-6 sm:flex">
                                                                    <div className="text-center">
                                                                        <div className="text-lg font-bold text-blue-600">
                                                                            {
                                                                                semesterStats.total
                                                                            }
                                                                        </div>
                                                                        <div className="text-xs text-gray-500">
                                                                            Pegawai
                                                                        </div>
                                                                    </div>
                                                                    <div className="text-center">
                                                                        <div className="text-lg font-bold text-green-600">
                                                                            {
                                                                                semesterStats.completed
                                                                            }
                                                                        </div>
                                                                        <div className="text-xs text-gray-500">
                                                                            Selesai
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </AccordionTrigger>

                                                        <AccordionContent className="bg-gradient-to-br from-gray-100 to-purple-50/30 p-6 px-6">
                                                            {/* Employee List */}
                                                            <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                                                {semester.employees.map(
                                                                    (
                                                                        employee,
                                                                    ) => (
                                                                        <Card
                                                                            key={
                                                                                employee.id
                                                                            }
                                                                            className="group overflow-hidden border-0 bg-white shadow-md transition-all duration-300 hover:scale-105 hover:shadow-xl"
                                                                        >
                                                                            <CardContent className="p-4">
                                                                                <div className="flex items-start gap-3">
                                                                                    <img
                                                                                        src={`/${employee.outsourcings.image}`}
                                                                                        alt={
                                                                                            employee
                                                                                                .outsourcings
                                                                                                .name
                                                                                        }
                                                                                        className="h-14 w-14 rounded-full border-2 border-purple-200 object-cover shadow-sm"
                                                                                    />
                                                                                    <div className="min-w-0 flex-1">
                                                                                        <h4 className="truncate font-semibold text-gray-900">
                                                                                            {
                                                                                                employee
                                                                                                    .outsourcings
                                                                                                    .name
                                                                                            }
                                                                                        </h4>
                                                                                        <p className="text-xs text-gray-500">
                                                                                            {
                                                                                                employee
                                                                                                    .outsourcings
                                                                                                    .jabatan
                                                                                            }
                                                                                        </p>
                                                                                        <div className="mt-2 flex items-center justify-between">
                                                                                            <Badge
                                                                                                className={`text-xs ${
                                                                                                    employee.status ===
                                                                                                    'completed'
                                                                                                        ? 'bg-green-100 text-green-700 hover:bg-green-200'
                                                                                                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                                                                                                }`}
                                                                                            >
                                                                                                {employee.status ===
                                                                                                'completed' ? (
                                                                                                    <CheckCircle className="mr-1 h-3 w-3" />
                                                                                                ) : (
                                                                                                    <Clock className="mr-1 h-3 w-3" />
                                                                                                )}
                                                                                                {employee.status ===
                                                                                                'completed'
                                                                                                    ? 'Selesai'
                                                                                                    : 'Pending'}
                                                                                            </Badge>
                                                                                            {employee.score && (
                                                                                                <div className="flex items-center gap-1 text-sm font-bold text-purple-600">
                                                                                                    <Award className="h-4 w-4" />
                                                                                                    {
                                                                                                        employee.score
                                                                                                    }
                                                                                                </div>
                                                                                            )}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <Link
                                                                                    href={`/penilaian/${employee.uuid}`}
                                                                                    className="mt-3 flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 py-2 text-sm font-medium text-white transition-all hover:from-purple-600 hover:to-indigo-700"
                                                                                >
                                                                                    <ClipboardList className="h-4 w-4" />
                                                                                    Lihat
                                                                                    Detail
                                                                                </Link>
                                                                            </CardContent>
                                                                        </Card>
                                                                    ),
                                                                )}
                                                            </div>
                                                        </AccordionContent>
                                                    </AccordionItem>
                                                );
                                            })}
                                        </Accordion>

                                        {/* Empty State for History */}
                                        {semesterHistory.length === 0 && (
                                            <Card className="border-0 bg-gradient-to-br from-gray-50 to-blue-50 py-16 text-center shadow-lg">
                                                <CardContent>
                                                    <div className="mx-auto mb-4 w-fit rounded-full bg-white p-6 shadow-lg">
                                                        <History className="h-16 w-16 text-gray-400" />
                                                    </div>
                                                    <h3 className="mb-2 text-xl font-bold text-gray-900">
                                                        Belum Ada Riwayat
                                                        Semester
                                                    </h3>
                                                    <p className="mx-auto max-w-md text-gray-500">
                                                        Riwayat penilaian dari
                                                        semester sebelumnya akan
                                                        muncul di sini
                                                    </p>
                                                </CardContent>
                                            </Card>
                                        )}
                                    </CardContent>
                                </Card>
                            </TabsContent>
                        </Tabs>
                    </div>
                </main>
            </div>
        </>
    );
}
