<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type' => 'required|string|max:255',
            'bbm' => 'required|string|max:255',
            'service_schedule' => 'nullable|date',
            'phone_number' => 'required|string|max:255', // Menambahkan validasi untuk nomor telepon
            'plate_number_type' => 'required|string|max:255', // Menambahkan validasi untuk jenis plat nomor
            'driver_id' => 'required|exists:drivers,id',
        ]);

        Order::create([
            'name' => $request->name,
            'vehicle_type' => $request->vehicle_type,
            'bbm' => $request->bbm,
            'service_schedule' => $request->service_schedule,
            'phone_number' => $request->phone_number,
            'plate_number_type' => $request->plate_number_type,
            'driver_id' => $request->driver_id,
        ]);

        Session::flash('success', 'Pemesanan berhasil dibuat.');
        return redirect()->back();    
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type' => 'required|string|max:255',
            'bbm' => 'required|string|max:255',
            'service_schedule' => 'nullable|date',
            'phone_number' => 'required|string|max:255', // Menambahkan validasi untuk nomor telepon
            'plate_number_type' => 'required|string|max:255', // Menambahkan validasi untuk jenis plat nomor
            'driver_id' => 'required|exists:drivers,id',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'name' => $request->name,
            'vehicle_type' => $request->vehicle_type,
            'bbm' => $request->bbm,
            'service_schedule' => $request->service_schedule,
            'phone_number' => $request->phone_number,
            'plate_number_type' => $request->plate_number_type,
            'driver_id' => $request->driver_id,
            // tambahkan kolom lainnya sesuai kebutuhan
        ]);

        return redirect()->route('admin.admin')->with('success', 'Order berhasil diperbarui.');
    }
      
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $drivers = Driver::all(); // Anda mungkin perlu mendapatkan data driver untuk formulir edit
        return view('admin.edit', compact('order', 'drivers'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.admin')->with('success', 'Order berhasil dihapus.');
    }

    public function approveAtasan1($id)
    {
        $order = Order::findOrFail($id);
        $order->approved_by_atasan1 = auth()->user()->id;
        $order->status = 'approved by atasan1';
        $order->save();

        return redirect()->back()->with('success', 'Pemesanan disetujui oleh Atasan 1.');
    }

    public function approveAtasan2($id)
    {
        $order = Order::findOrFail($id);
        if (!$order->approved_by_atasan1) {
            return redirect()->back()->with('error', 'Pemesanan belum disetujui oleh Atasan 1.');
        }
        $order->approved_by_atasan2 = auth()->user()->id;
        $order->status = 'approved by atasan2';
        $order->save();

        return redirect()->back()->with('success', 'Pemesanan disetujui oleh Atasan 2.');
    }
    
    public function rejectAtasan1($id)
    {
        $order = Order::find($id);
        $order->status = 'rejected by atasan1';
        $order->save();

        return redirect()->back()->with('error', 'Order rejected by Atasan1.');
    }

    public function rejectAtasan2($id)
    {
        $order = Order::find($id);
        $order->status = 'rejected by atasan2';
        $order->save();

        return redirect()->back()->with('error', 'Order rejected by Atasan2.');
    }
    
    public function export()
    {
        $orders = Order::all();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Jenis Kendaraan');
        $sheet->setCellValue('D1', 'Konsumsi BBM');
        $sheet->setCellValue('E1', 'Nomor Telepon');
        $sheet->setCellValue('F1', 'Plat Nomor');
        $sheet->setCellValue('G1', 'Jadwal Service');
        $sheet->setCellValue('H1', 'Driver');
        $sheet->setCellValue('I1', 'Status');
    
        // Tulis data pesanan
        $row = 2;
        foreach ($orders as $order) {
            $sheet->setCellValue('A'.$row, $order->id);
            $sheet->setCellValue('B'.$row, $order->name);
            $sheet->setCellValue('C'.$row, $order->vehicle_type);
            $sheet->setCellValue('D'.$row, $order->bbm);
            $sheet->setCellValue('E'.$row, $order->phone_number);
            $sheet->setCellValue('F'.$row, $order->plate_number_type);
            $sheet->setCellValue('G'.$row, $order->service_schedule);
            $sheet->setCellValue('H'.$row, $order->driver->name);
            $sheet->setCellValue('I'.$row, $order->status);
            $row++;
        }
    
        // Simpan file Excel ke dalam response
        $writer = new Xlsx($spreadsheet);
        $filename = 'Data Order.xlsx';
        $writer->save($filename);
    
        return response()->download($filename);
    }    
}
