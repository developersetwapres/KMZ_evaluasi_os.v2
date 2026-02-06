'use client';

import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import AdminLayout from '@/layouts/app/app-adminkmz-layout';
import { Trophy } from 'lucide-react';
import { useMemo, useState } from 'react';

// Helper: slugify jabatan to value used by Select
const slugify = (str: string) =>
    str
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)/g, '');

// Custom tooltip component (adapted to new keys)
const CustomTooltip = ({ active, payload, label }: any) => {
    if (active && payload && payload.length) {
        const data = payload[0].payload;

        return (
            <div className="rounded-lg border border-border bg-card p-4 shadow-lg">
                <p className="mb-2 font-semibold text-card-foreground">
                    {label}
                </p>
                <div className="space-y-1">
                    <p className="text-sm">
                        <span className="mr-2 inline-block h-3 w-3 rounded bg-[#3b82f6]"></span>
                        Atasan:{' '}
                        <span className="font-medium">{data.Atasan}</span>
                    </p>
                    <p className="text-sm">
                        <span className="mr-2 inline-block h-3 w-3 rounded bg-[#10b981]"></span>
                        Penerima Layanan:{' '}
                        <span className="font-medium">
                            {data['Penerima Layanan']}
                        </span>
                    </p>
                    <p className="text-sm">
                        <span className="mr-2 inline-block h-3 w-3 rounded bg-[#f59e0b]"></span>
                        Teman Setingkat:{' '}
                        <span className="font-medium">
                            {data['Teman Setingkat']}
                        </span>
                    </p>
                    <div className="mt-2 border-t pt-2">
                        <p className="font-semibold">
                            Total Score: {data.total}
                        </p>
                    </div>
                </div>
            </div>
        );
    }
    return null;
};

// Props: expect `outsourcingData` to be the array from the BE example
export default function RankingPage({ outsourcingData }: any) {
    // build positions from outsourcingData
    const positions = useMemo(() => {
        if (!Array.isArray(outsourcingData)) return [];
        return outsourcingData.map((d: any) => ({
            value: slugify(d.jabatan || d.job || ''),
            label: d.jabatan,
        }));
    }, [outsourcingData]);

    // map outsourcingData into a lookup by slug
    const dataMap = useMemo(() => {
        const map: Record<string, any[]> = {};
        if (!Array.isArray(outsourcingData)) return map;

        outsourcingData.forEach((group: any) => {
            const key = slugify(group.jabatan || 'unknown');
            const ranking = Array.isArray(group.ranking) ? group.ranking : [];

            // transform each item to the shape used by the FE
            const transformed = ranking
                .map((item: any) => ({
                    name: item.nama ?? item.name ?? 'N/A',
                    Atasan: Number(item.atasan ?? 0),
                    'Penerima Layanan': Number(
                        item.penerima_layanan ?? item['penerima_layanan'] ?? 0,
                    ),
                    'Teman Setingkat': Number(item.teman ?? 0),
                    total: Number(item.total ?? 0),
                    rank: Number(item.ranking ?? item.rank ?? 0),
                }))
                .sort((a: any, b: any) => a.rank - b.rank);

            map[key] = transformed;
        });

        return map;
    }, [outsourcingData]);

    const defaultPosition = positions?.[0]?.value ?? '';
    const [selectedPosition, setSelectedPosition] = useState(defaultPosition);
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 20;

    const currentData = dataMap[selectedPosition] || [];

    const totalPages = Math.ceil(currentData.length / itemsPerPage) || 0;
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedData = currentData.slice(startIndex, endIndex);

    const handlePositionChange = (value: string) => {
        setSelectedPosition(value);
        setCurrentPage(1);
    };

    const topPerformer = currentData[0] || { name: 'N/A', total: 0 };
    const averageScore =
        currentData.length > 0
            ? Math.round(
                  currentData.reduce(
                      (sum: number, item: any) => sum + Number(item.total || 0),
                      0,
                  ) / currentData.length,
              )
            : 0;

    return (
        <AdminLayout>
            <div className="space-y-6">
                {/* Header Card */}
                <Card className="bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                    <CardHeader>
                        <CardTitle className="text-2xl">
                            Ranking Evaluasi Outsourcing
                        </CardTitle>
                        <CardDescription className="text-indigo-100">
                            Dashboard penilaian kinerja outsourcing berdasarkan
                            evaluasi multi-penilai.
                        </CardDescription>
                    </CardHeader>
                </Card>

                <Card>
                    <CardHeader>
                        <div className="flex flex-col space-y-4">
                            <div className="flex flex-wrap gap-4">
                                <div className="flex items-center space-x-2">
                                    <Trophy className="h-4 w-4 text-muted-foreground" />
                                    <Select
                                        value={selectedPosition}
                                        onValueChange={handlePositionChange}
                                    >
                                        <SelectTrigger className="w-72">
                                            <SelectValue placeholder="Pilih Jabatan Outsourcing" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {positions.map((position: any) => (
                                                <SelectItem
                                                    key={position.value}
                                                    value={position.value}
                                                >
                                                    {position.label}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                </div>
                            </div>
                        </div>
                    </CardHeader>

                    <CardContent>//</CardContent>
                </Card>
            </div>
        </AdminLayout>
    );
}
