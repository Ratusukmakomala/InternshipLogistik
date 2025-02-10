<table>
    <thead>
        <tr>
            <th>Nama Pengirim</th>
            <th>Telepon Pengirim</th>
            <th>Alamat Pengirim</th>
            <th>Kode Pos Pengirim</th>
            <th>Nama Penerima</th>
            <th>Telepon Penerima</th>
            <th>Alamat Penerima</th>
            <th>Kode Pos Penerima</th>
            <th>Isi Barang</th>
            <th>Berat Barang (Kg)</th>
            <th>Layanan Pengiriman</th>
            <th>Catatan Pengiriman</th>
            <th>Nomor Resi</th>
            <th>Jenis Barang</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($reports as $report)
            <tr>
                <td>{{ $report->sender_name }}</td>
                <td>{{ $report->sender_phone }}</td>
                <td>{{ $report->sender_address }}</td>
                <td>{{ $report->sender_zip_code }}</td>
                <td>{{ $report->receive_name }}</td>
                <td>{{ $report->receive_phone }}</td>
                <td>{{ $report->receive_address }}</td>
                <td>{{ $report->receive_zip_code }}</td>
                <td>{{ $report->shipping_form }}</td>
                <td>{{ $report->weight }}</td>
                <td>{{ $report->name }}</td>
                <td>{{ $report->note }}</td>
                <td>{{ $report->receipt_number }}</td>
                <td>{{ $report->kind_delivery }}</td>
            </tr>
        @empty
            <x-table.empty-data colspan="15" />
        @endforelse
    </tbody>
</table>
