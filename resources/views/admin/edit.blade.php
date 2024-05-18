@extends('layouts.app')

@section('content')

<div class="container col-md-6">
    <h2>Edit Order</h2>
    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb">
            <label for="name" class="form-label">Nama:</label><br>
            <input type="text" id="name" name="name" class="form-control" required><br>
        </div>

        <div class="mb">
            <label for="vehicle" class="form-label">Jenis Kendaraan:</label><br>
            <select id="vehicle" name="vehicle_type" class="form-select" required>
                <option value="angkutan orang" {{ $order->vehicle_type === 'angkutan orang' ? 'selected' : '' }}>Angkutan Orang</option>
                <option value="angkutan barang" {{ $order->vehicle_type === 'angkutan barang' ? 'selected' : '' }}>Angkutan Barang</option>
            </select><br>
        </div>
        
        <div class="mb">
            <label for="bbm" class="form-label">Konsumsi BBM:</label><br>
            <select id="bbm" name="bbm" class="form-select" required>
                <option value="10 liter perhari" {{ $order->bbm === '10 liter perhari' ? 'selected' : '' }}>10 Liter Per-Hari</option>
                <option value="20 liter perhari" {{ $order->bbm === '20 liter perhari' ? 'selected' : '' }}>20 Liter Per-Hari</option>
                <option value="40 liter perminggu" {{ $order->bbm === '40 liter perminggu' ? 'selected' : '' }}>40 Liter Per-Minggu</option>
            </select><br> 
        </div>

        <div class="mb">
            <label for="bbm" class="form-label">Plat Nomor: </label><br>
            <select id="plate_number_type" name="plate_number_type" class="form-select" required>
                <option value="B 1234 ABC" {{ $order->plate_number_type === 'B 1234 ABC' ? 'selected' : '' }}>B 1234 ABC</option>
                <option value="D 5678 XYZ" {{ $order->plate_number_type === 'D 5678 XYZ' ? 'selected' : '' }}>D 5678 XYZ</option>
                <option value="AB 1234 CD" {{ $order->plate_number_type === 'AB 1234 CD' ? 'selected' : '' }}>AB 1234 CD</option>
                <option value="W 9999 PP"  {{ $order->plate_number_type === 'W 9999 PP' ? 'selected' : '' }}>W 9999 PP</option>
            </select><br> 
        </div>

        <div class="mb">
            <label for="phone_number" class="form-label">Nomor Telepon:</label><br>
            <input type="text" id="phone_number" name="phone_number" class="form-control" required><br>
        </div>
        
        <div class="mb">
            <label for="service_schedule" class="form-label">Jadwal Service:</label><br>
            <input type="datetime-local" id="service_schedule" name="service_schedule" value="{{ $order->service_schedule }}" class="form-control"><br>
        </div>
        
        <div class="mb">
            <label for="driver" class="form-label">Pilih Driver:</label><br>
            <select id="driver" name="driver_id" class="form-select" required>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}" {{ $driver->id === $order->driver_id ? 'selected' : '' }}>{{ $driver->name }}</option>
                @endforeach
            </select><br>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Order</button>
    </form>
</div>

@endsection
