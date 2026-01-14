<div style="max-width: 250px; border: 1px solid #e5e7eb; border-radius: 8px; padding: 15px; background: #f9fafb;">
    @if($getRecord()->qr_code)
        <div style="margin-bottom: 10px;">
            {!! base64_decode($getRecord()->qr_code) !!}
        </div>
        <p style="font-size: 12px; color: #6b7280; margin: 0; text-align: center;">
            Token: {{ $getRecord()->qr_token }}
        </p>
    @else
        <p style="color: #9ca3af; text-align: center; margin: 0;">QR Code tidak tersedia</p>
    @endif
</div>