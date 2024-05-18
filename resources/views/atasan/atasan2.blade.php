@extends('layouts.app')

@section('content')

<div class="container col-md-10">
    <h1>Welcome Atasan2!</h1>

    <h2>Daftar Pemesanan Kendaraan</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jenis Kendaraan</th>
                <th>Konsumsi BBM</th>
                <th>Jadwal Service</th>
                <th>Plat Nomor</th>
                <th>Nomor Telepon</th>
                <th>Driver</th>
                <th>Status</th>
                <th>Aksi</th>
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
                    <td>{{ $order->driver->name }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        @if($order->status == 'approved by atasan1')
                            <form action="{{ route('orders.approveAtasan2', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Setujui</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
