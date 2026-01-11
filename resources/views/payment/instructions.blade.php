@extends('layout')

@section('content')
<style>
    .payment-container {
        max-width: 700px;
        margin: 40px auto;
    }
    .payment-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    .payment-header {
        background: linear-gradient(135deg, #2d5f5d 0%, #1a3a38 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }
    .payment-header h1 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .payment-header .order-info {
        background: rgba(255,255,255,0.15);
        padding: 12px 20px;
        border-radius: 8px;
        display: inline-block;
        margin-top: 10px;
    }
    .payment-body {
        padding: 40px;
        background: white;
    }
    .instruction-section {
        margin-bottom: 30px;
    }
    .instruction-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .instruction-title svg {
        width: 24px;
        height: 24px;
        color: #2d5f5d;
    }
    .bank-details {
        background: #f7fafc;
        border-left: 4px solid #2d5f5d;
        border-radius: 8px;
        padding: 0;
        list-style: none;
        overflow: hidden;
    }
    .bank-details li {
        padding: 16px 24px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .bank-details li:last-child {
        border-bottom: none;
    }
    .bank-label {
        font-weight: 600;
        color: #718096;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .bank-value {
        font-weight: 700;
        color: #2d3748;
        font-size: 1.1rem;
    }
    .bank-value.reference {
        color: #2d5f5d;
        font-family: 'Courier New', monospace;
    }
    .copy-btn {
        background: #2d5f5d;
        color: white;
        border: none;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        cursor: pointer;
        transition: background 0.2s;
    }
    .copy-btn:hover {
        background: #1a3a38;
    }
    .alert-info {
        background: #e6f7ff;
        border: 1px solid #91d5ff;
        color: #0050b3;
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: start;
        gap: 12px;
    }
    .alert-info svg {
        width: 20px;
        height: 20px;
        margin-top: 2px;
        flex-shrink: 0;
    }
    .mock-section {
        background: #fff7e6;
        border: 2px dashed #ffa940;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
    }
    .mock-section p {
        color: #ad6800;
        font-size: 0.875rem;
        margin-bottom: 15px;
    }
    .btn-mock {
        background: #fa8c16;
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-mock:hover {
        background: #d46b08;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(250, 140, 22, 0.3);
    }
    .steps-guide {
        background: #f7fafc;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
    }
    .steps-guide ol {
        margin: 0;
        padding-left: 24px;
    }
    .steps-guide li {
        margin-bottom: 8px;
        color: #4a5568;
    }
</style>

<div class="payment-container">
    <div class="payment-card">
        <!-- Header -->
        <div class="payment-header">
            <svg width="48" height="48" fill="currentColor" viewBox="0 0 16 16" style="margin-bottom: 15px;">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
            </svg>
            <h1>Payment Instructions</h1>
            <div class="order-info">
                <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 4px;">Order Number</div>
                <div style="font-size: 1.25rem; font-weight: 700;">{{ $order->order_number }}</div>
                <div style="font-size: 1.5rem; font-weight: 700; margin-top: 8px;">
                    Rp {{ number_format($order->total, 0, ',', '.') }}}
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="payment-body">
            <!-- Alert Info -->
            <div class="alert-info">
                <svg fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </svg>
                <div>
                    <strong>Please complete your payment</strong><br>
                    Transfer the exact amount to the bank account below and use the reference number provided.
                </div>
            </div>

            <!-- Bank Details Section -->
            <div class="instruction-section">
                <div class="instruction-title">
                    <svg fill="currentColor" viewBox="0 0 16 16">
                        <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89L8 0ZM3.777 3h8.447L8 1 3.777 3ZM2 6v7h1V6H2Zm2 0v7h2.5V6H4Zm3.5 0v7h1V6h-1Zm2 0v7H12V6H9.5ZM13 6v7h1V6h-1Zm2-1V4H1v1h14Zm-.39 9H1.39l-.25 1h13.72l-.25-1Z"/>
                    </svg>
                    Bank Transfer Details
                </div>
                <ul class="bank-details">
                    <li>
                        <span class="bank-label">Bank Name</span>
                        <span class="bank-value">Tendakian Bank</span>
                    </li>
                    <li>
                        <span class="bank-label">Account Number</span>
                        <div class="d-flex align-items-center gap-2">
                            <span class="bank-value">123-456-789</span>
                            <button class="copy-btn" onclick="copyToClipboard('123-456-789')">Copy</button>
                        </div>
                    </li>
                    <li>
                        <span class="bank-label">Reference Number</span>
                        <div class="d-flex align-items-center gap-2">
                            <span class="bank-value reference">{{ $order->order_number }}</span>
                            <button class="copy-btn" onclick="copyToClipboard('{{ $order->order_number }}')">Copy</button>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Steps Guide -->
            <div class="steps-guide">
                <h6 style="font-weight: 600; margin-bottom: 12px; color: #2d3748;">Payment Steps:</h6>
                <ol>
                    <li>Log in to your online banking or visit any branch</li>
<li>Transfer <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong> ke rekening di atas</li>
                    <li>Use <strong>{{ $order->order_number }}</strong> as your payment reference</li>
                    <li>Keep your transaction receipt for verification</li>
                    <li>Your order will be processed once payment is confirmed</li>
                </ol>
            </div>

            <!-- Mock Payment Section (Testing) -->
            <div class="mock-section">
                <svg width="24" height="24" fill="#ad6800" viewBox="0 0 16 16" style="margin-bottom: 10px;">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                </svg>
                <p><strong>Testing Mode:</strong> After you have completed the transfer, you can use the button below to simulate payment confirmation (for testing purposes only).</p>
                <form method="POST" action="{{ route('payment.mock', ['id' => $order->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-mock">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 6px; vertical-align: -2px;">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                        Mark as Paid (Mock)
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        // Optional: Show a toast notification
        alert('Copied to clipboard: ' + text);
    }).catch(err => {
        console.error('Failed to copy:', err);
    });
}
</script>
@endsection