@extends('layouts.app')

@section('content')

<div class="container col-md-5">
    <h2 class="text-2xl font-bold mt-4 mb-2">Grafik Pemakaian Kendaraan</h2>
    <div>
        <canvas id="usageChart" width="400" height="200"></canvas>
    </div>
</div>


<div class="container col-md-9">
    <h2 class="text-2xl font-bold mb-4">Buat Pemesanan Kendaraan</h2>
    <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="mb">
            <label for="name" class="form-label">Nama:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb">
            <label for="vehicle" class="form-label">Jenis Kendaraan:</label>
            <select id="vehicle" name="vehicle_type" class="form-select" required>
                <option value="angkutan orang">Angkutan Orang</option>
                <option value="angkutan barang">Angkutan Barang</option>
            </select>
        </div>
        
        <div class="mb">
            <label for="bbm" class="form-label">Konsumsi BBM:</label>
            <select id="bbm" name="bbm" class="form-select" required>
                <option value="10 liter perhari">10 Liter Per-Hari</option>
                <option value="20 liter perhari">20 Liter Per-Hari</option>
                <option value="40 liter perminggu">40 Liter Per-Minggu</option>
            </select>
        </div>

        <div class="mb">
            <label for="plate_number" class="form-label">Plat Nomor:</label>
            <select id="plate_number" name="plate_number_type" class="form-select" required>
                <option value="B 1234 ABC">B 1234 ABC</option>
                <option value="D 5678 XYZ">D 5678 XYZ</option>
                <option value="AB 1234 CD">AB 1234 CD</option>
                <option value="W 9999 PP">W 9999 PP</option>
            </select>
        </div>

        <div class="mb">
            <label for="phone_number" class="form-label">Nomor Telepon:</label>
            <input type="text" id="phone_number" name="phone_number" class="form-control" required>
        </div>

        <div class="mb">
            <label for="service_schedule" class="form-label">Jadwal Service:</label>
            <input type="datetime-local" id="service_schedule" name="service_schedule" class="form-control">
        </div>
        
        <div class="mb">
            <label for="driver" class="form-label">Pilih Driver:</label>
            <select id="driver" name="driver_id" class="form-select" required>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mb-2" style="margin: 5px">Buat Pemesanan</button>
    </form>

    <h2 class="text-2xl font-bold mt-4 mb-2">Daftar Pemesanan Kendaraan</h2>
    <div>
        <a href="{{ route('orders.export') }}" class="btn btn-success mb-4">Export Excel</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis Kendaraan</th>
                <th scope="col">Konsumsi BBM</th>
                <th scope="col">Jadwal Service</th>
                <th scope="col">Plat Nomor</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col">Driver</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->vehicle_type }}</td>
                    <td>{{ $order->bbm }}</td>
                    <td>{{ $order->service_schedule }}</td>
                    <td>{{ $order->plate_number_type }}</td>
                    <td>{{ $order->phone_number }}</td>
                    <td>{{ $order->driver ? $order->driver->name : 'N/A' }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
