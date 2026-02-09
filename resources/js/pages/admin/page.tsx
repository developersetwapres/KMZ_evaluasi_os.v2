// import {
//     Card,
//     CardContent,
//     CardDescription,
//     CardHeader,
//     CardTitle,
// } from '@/components/ui/card';
// import AdminLayout from '@/layouts/app/app-adminkmz-layout';
// import { BarChart3, CheckCircle, TrendingUp, Users } from 'lucide-react';

// // Mock data - replace with actual data fetching
// const evaluationResults = {
//     totalEvaluations: 150,
//     completedEvaluations: 120,
//     averageScore: 78.5,
//     pendingReviews: 30,
// };

// export default function ResultsRecapPage() {
//     return (
//         <AdminLayout>
//             <div className="space-y-6">
//                 <div>
//                     <h2 className="text-2xl font-bold text-gray-900">
//                         Rekap Hasil Evaluasi
//                     </h2>
//                     <p className="text-muted-foreground">
//                         Ringkasan hasil penilaian kinerja outsourcing
//                     </p>
//                 </div>

//                 <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
//                     <Card>
//                         <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
//                             <CardTitle className="text-sm font-medium">
//                                 Total Evaluasi
//                             </CardTitle>
//                             <BarChart3 className="h-4 w-4 text-muted-foreground" />
//                         </CardHeader>
//                         <CardContent>
//                             <div className="text-2xl font-bold">
//                                 {evaluationResults.totalEvaluations}
//                             </div>
//                             <p className="text-xs text-muted-foreground">
//                                 evaluasi terdaftar
//                             </p>
//                         </CardContent>
//                     </Card>

//                     <Card>
//                         <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
//                             <CardTitle className="text-sm font-medium">
//                                 Selesai
//                             </CardTitle>
//                             <CheckCircle className="h-4 w-4 text-green-500" />
//                         </CardHeader>
//                         <CardContent>
//                             <div className="text-2xl font-bold">
//                                 {evaluationResults.completedEvaluations}
//                             </div>
//                             <p className="text-xs text-muted-foreground">
//                                 evaluasi selesai
//                             </p>
//                         </CardContent>
//                     </Card>

//                     <Card>
//                         <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
//                             <CardTitle className="text-sm font-medium">
//                                 Rata-rata Skor
//                             </CardTitle>
//                             <TrendingUp className="h-4 w-4 text-blue-500" />
//                         </CardHeader>
//                         <CardContent>
//                             <div className="text-2xl font-bold">
//                                 {evaluationResults.averageScore}
//                             </div>
//                             <p className="text-xs text-muted-foreground">
//                                 dari 100 poin
//                             </p>
//                         </CardContent>
//                     </Card>

//                     <Card>
//                         <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
//                             <CardTitle className="text-sm font-medium">
//                                 Pending Review
//                             </CardTitle>
//                             <Users className="h-4 w-4 text-orange-500" />
//                         </CardHeader>
//                         <CardContent>
//                             <div className="text-2xl font-bold">
//                                 {evaluationResults.pendingReviews}
//                             </div>
//                             <p className="text-xs text-muted-foreground">
//                                 menunggu review
//                             </p>
//                         </CardContent>
//                     </Card>
//                 </div>

//                 <Card>
//                     <CardHeader>
//                         <CardTitle>Detail Rekap Hasil</CardTitle>
//                         <CardDescription>
//                             Tabel detail hasil evaluasi kinerja
//                         </CardDescription>
//                     </CardHeader>
//                     <CardContent>
//                         <div className="rounded-md border">
//                             <table className="w-full text-sm">
//                                 <thead className="bg-muted/50">
//                                     <tr>
//                                         <th className="px-4 py-3 text-left font-medium">
//                                             Nama Karyawan
//                                         </th>
//                                         <th className="px-4 py-3 text-left font-medium">
//                                             Unit Kerja
//                                         </th>
//                                         <th className="px-4 py-3 text-left font-medium">
//                                             Skor
//                                         </th>
//                                         <th className="px-4 py-3 text-left font-medium">
//                                             Status
//                                         </th>
//                                     </tr>
//                                 </thead>
//                                 <tbody>
//                                     <tr className="border-t">
//                                         <td className="px-4 py-3">
//                                             Ahmad Fadli
//                                         </td>
//                                         <td className="px-4 py-3">
//                                             IT Support
//                                         </td>
//                                         <td className="px-4 py-3">85</td>
//                                         <td className="px-4 py-3">
//                                             <span className="rounded-full bg-green-100 px-2 py-1 text-xs text-green-700">
//                                                 Selesai
//                                             </span>
//                                         </td>
//                                     </tr>
//                                     <tr className="border-t">
//                                         <td className="px-4 py-3">
//                                             Siti Nurhaliza
//                                         </td>
//                                         <td className="px-4 py-3">Admin</td>
//                                         <td className="px-4 py-3">78</td>
//                                         <td className="px-4 py-3">
//                                             <span className="rounded-full bg-green-100 px-2 py-1 text-xs text-green-700">
//                                                 Selesai
//                                             </span>
//                                         </td>
//                                     </tr>
//                                     <tr className="border-t">
//                                         <td className="px-4 py-3">
//                                             Budi Santoso
//                                         </td>
//                                         <td className="px-4 py-3">Security</td>
//                                         <td className="px-4 py-3">-</td>
//                                         <td className="px-4 py-3">
//                                             <span className="rounded-full bg-orange-100 px-2 py-1 text-xs text-orange-700">
//                                                 Pending
//                                             </span>
//                                         </td>
//                                     </tr>
//                                 </tbody>
//                             </table>
//                         </div>
//                     </CardContent>
//                 </Card>
//             </div>
//         </AdminLayout>
//     );
// }
