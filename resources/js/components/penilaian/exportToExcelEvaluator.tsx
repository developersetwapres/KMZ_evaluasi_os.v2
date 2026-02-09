import * as XLSX from 'xlsx';

export default function exportToExcelEvaluator(evaluationResults: any[]) {
    const formattedData = evaluationResults.map((item: any, index: number) => {
        return {
            ID: index + 1,
            Evaluator: item.evaluator_name,
            Tipe_Penilai: item.tipe_penilai,
            Status: item.status,
            Outsourcing: item.outsourcing_name,
            Jabatan: item.outsourcing_jabatan,
        };
    });

    // 2. Buat worksheet dari data
    const worksheet = XLSX.utils.json_to_sheet(formattedData);

    // 3. Buat workbook
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');

    // 4. Simpan sebagai file xlsx
    return XLSX.writeFile(workbook, 'evaluators.xlsx');
}
