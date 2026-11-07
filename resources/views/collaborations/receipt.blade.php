<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran #TX-IM-{{ $endorsement->id }}</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; background: #f3f4f6; padding: 2rem; display: flex; justify-content: center; }
        .receipt { background: white; padding: 2rem; width: 400px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border-radius: 8px; border: 1px dashed #ccc; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .mt-4 { margin-top: 1rem; }
        .mb-2 { margin-bottom: 0.5rem; }
        .divider { border-bottom: 1px dashed #ccc; margin: 1rem 0; }
        .flex { display: flex; justify-content: space-between; }
        .text-sm { font-size: 0.875rem; }
        @media print {
            body { background: white; padding: 0; display: block; }
            .receipt { box-shadow: none; width: 100%; max-width: 400px; margin: 0 auto; border: none; }
            .no-print { display: none; }
        }
        .btn-print { background: #4f46e5; color: white; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer; font-family: inherit; margin-bottom: 1rem; display: block; width: 100%; }
        .btn-print:hover { background: #4338ca; }
    </style>
</head>
<body>
    <div class="receipt">
        <button class="no-print btn-print" onclick="window.print()">🖨️ Print Struk</button>
        
        <div class="text-center">
            <h2 class="font-bold mb-2">INMATCH</h2>
            <p class="text-sm">Platform Layanan Jasa Digital Kreatif</p>
        </div>
        
        <div class="divider"></div>
        
        <div class="text-center font-bold">
            STRUK PEMBAYARAN RESMI
        </div>
        
        <div class="divider"></div>
        
        <div class="text-sm">
            <div class="flex"><span>No. Transaksi</span><span>#TX-IM-{{ $endorsement->id }}</span></div>
            <div class="flex"><span>Tanggal</span><span>{{ now()->format('d M Y, H:i') }}</span></div>
            <div class="flex"><span>Client</span><span>{{ $endorsement->client->name ?? $endorsement->vendor->name }}</span></div>
            <div class="flex"><span>Creator</span><span>{{ $endorsement->creator->name ?? $endorsement->influencer->name }}</span></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="text-sm">
            <div class="font-bold mb-2">DETAIL PROJECT:</div>
            <div>{{ $endorsement->description }}</div>
        </div>
        
        <div class="divider"></div>
        
        <div class="flex font-bold">
            <span>TOTAL BAYAR</span>
            <span>Rp {{ number_format($endorsement->offered_price, 0, ',', '.') }}</span>
        </div>
        <div class="flex text-sm mt-4">
            <span>METODE PEMBAYARAN</span>
            @php
                // Get the payment method from the chat message if available
                $receiptMsg = $endorsement->chats()->where('message', 'LIKE', 'RECEIPT|%')->first();
                $method = 'UNKNOWN';
                if ($receiptMsg) {
                    $parts = explode('|', $receiptMsg->message);
                    if (isset($parts[4])) $method = $parts[4];
                }
            @endphp
            <span class="font-bold">{{ $method }}</span>
        </div>
        <div class="flex text-sm mt-2">
            <span>STATUS</span>
            <span class="font-bold">LUNAS / BERHASIL</span>
        </div>
        
        <div class="divider"></div>
        
        <div class="text-center text-sm">
            <p>Terima kasih telah menggunakan InMatch!</p>
            <p>Kolaborasi kini berstatus AKTIF.</p>
        </div>
    </div>
</body>
</html>
