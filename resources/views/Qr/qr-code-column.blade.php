<div style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border: 1px solid #e5e7eb; border-radius: 4px; padding: 2px;">
    @if($getRecord()->qr_code)
        <div style="width: 30px; height: 30px;">
            {!! base64_decode($getRecord()->qr_code) !!}
        </div>
    @else
        <span style="font-size: 10px; color: #9ca3af;">No QR</span>
    @endif
</div>