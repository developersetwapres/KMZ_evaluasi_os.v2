'use client';

import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/react';
import { Award, FileText, MessageCircle, Users } from 'lucide-react';

import { detailperaspek } from '@/routes/os';
import { usePage } from '@inertiajs/react';

interface EmployeeNavigationProps {
    employeeUuid: string;
}

export function EmployeeNavigation({ employeeUuid }: EmployeeNavigationProps) {
    const { url } = usePage();
    const isActive = (path: string) => url == path;

    return (
        <div className="mb-5 grid w-full grid-cols-4 rounded-lg border border-gray-200 bg-white p-1 shadow-sm">
            <Link href={`/employee/${employeeUuid}/rekap`} className="contents">
                <Button
                    variant="ghost"
                    className={`flex items-center space-x-2 rounded-md ${
                        isActive(`/employee/${employeeUuid}/rekap`)
                            ? 'bg-indigo-500 text-white hover:bg-indigo-600 hover:text-white'
                            : 'hover:bg-gray-100'
                    }`}
                >
                    <FileText className="h-4 w-4" />
                    <span className="hidden sm:inline">Rekap</span>
                </Button>
            </Link>

            <Link href={detailperaspek.url(employeeUuid)} className="contents">
                <Button
                    variant="ghost"
                    className={`flex items-center space-x-2 rounded-md ${
                        isActive(`/employee/${employeeUuid}/detail`)
                            ? 'bg-indigo-500 text-white hover:bg-indigo-600 hover:text-white'
                            : 'hover:bg-gray-100'
                    }`}
                >
                    <Users className="h-4 w-4" />
                    <span className="hidden sm:inline">Detail</span>
                </Button>
            </Link>

            <Link
                href={`/employee/${employeeUuid}/catatan`}
                className="contents"
            >
                <Button
                    variant="ghost"
                    className={`flex items-center space-x-2 rounded-md ${
                        isActive(`/employee/${employeeUuid}/catatan`)
                            ? 'bg-indigo-500 text-white hover:bg-indigo-600 hover:text-white'
                            : 'hover:bg-gray-100'
                    }`}
                >
                    <MessageCircle className="h-4 w-4" />
                    <span className="hidden sm:inline">Catatan Ket.</span>
                </Button>
            </Link>

            <Link
                href={`/employee/${employeeUuid}/pertanyaan`}
                className="contents"
            >
                <Button
                    variant="ghost"
                    className={`flex items-center space-x-2 rounded-md ${
                        isActive(`/employee/${employeeUuid}/pertanyaan`)
                            ? 'bg-indigo-500 text-white hover:bg-indigo-600 hover:text-white'
                            : 'hover:bg-gray-100'
                    }`}
                >
                    <Award className="h-4 w-4" />
                    <span className="hidden sm:inline">Per-Pertanyaan</span>
                </Button>
            </Link>
        </div>
    );
}
