'use client';

import {
    Card,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import AdminLayout from '@/layouts/app/app-adminkmz-layout';
import { evaluators, outsourcings } from '@/routes/penugasan';
import { Link } from '@inertiajs/react';
import { Download, Users2 } from 'lucide-react';

export default function StatusPenilaian() {
    return (
        <AdminLayout>
            <div className="space-y-6">
                {/* Header Card */}
                <Card className="bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
                    <CardHeader>
                        <CardTitle className="flex items-center space-x-2 text-2xl">
                            <Users2 className="h-6 w-6" />
                            <span>Status Penilaian</span>
                        </CardTitle>
                        <CardDescription className="text-purple-100">
                            Rekap status penilaian oleh by evaluators dan by
                            outsourcings.
                        </CardDescription>
                    </CardHeader>
                </Card>

                <Card>
                    <CardHeader>
                        <div className="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                            {/* Kiri */}
                            <div>
                                <CardTitle>BELUM ADA PAGE</CardTitle>
                                <CardDescription>//</CardDescription>
                            </div>

                            {/* Kanan */}
                            <div className="flex gap-2 md:justify-end">
                                <Link
                                    className="flex items-center gap-2 rounded-md bg-gray-900 px-4 py-1.5 text-sm text-white hover:bg-black"
                                    href={evaluators.url()}
                                >
                                    <Download className="h-4 w-4" />
                                    <span>Export by Evaluator</span>
                                </Link>

                                <Link
                                    className="flex items-center gap-2 rounded-md bg-gray-900 px-4 py-1.5 text-sm text-white hover:bg-black"
                                    href={outsourcings.url()}
                                >
                                    <Download className="h-4 w-4" />
                                    <span>Export by Outsourcing</span>
                                </Link>
                            </div>
                        </div>
                    </CardHeader>
                </Card>
            </div>
        </AdminLayout>
    );
}
