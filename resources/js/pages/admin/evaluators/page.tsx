'use client';

import exportToExcelEvaluator from '@/components/penilaian/exportToExcelEvaluator';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import AdminLayout from '@/layouts/app/app-adminkmz-layout';
import { Download, Users2 } from 'lucide-react';

export default function ResultsRecapPage({ evaluators }: any) {
    return (
        <AdminLayout>
            <div className="space-y-6">
                {/* Header Card */}
                <Card className="bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
                    <CardHeader>
                        <CardTitle className="flex items-center space-x-2 text-2xl">
                            <Users2 className="h-6 w-6" />
                            <span>Evaluator</span>
                        </CardTitle>
                        <CardDescription className="text-purple-100">
                            Lihat daftar evaluator pada peniliaan kinerja
                            outsourcing.
                        </CardDescription>
                    </CardHeader>
                </Card>

                <Card>
                    <CardHeader>
                        <Button
                            className="flex items-center space-x-2"
                            onClick={() => exportToExcelEvaluator(evaluators)}
                        >
                            <Download className="h-4 w-4" />
                            <span>Export</span>
                        </Button>
                        <CardTitle>BELUM ADA PAGE</CardTitle>
                        <CardDescription></CardDescription>
                    </CardHeader>
                </Card>
            </div>
        </AdminLayout>
    );
}
