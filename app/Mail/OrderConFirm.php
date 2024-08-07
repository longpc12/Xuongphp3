<?php

namespace App\Mail;

use App\Models\Bill;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConFirm extends Mailable
{
    use Queueable, SerializesModels;
   public $bill;
    /**
     * Create a new message instance.
     */
    public function __construct(Bill $Bill )
    {
        $this->bill = $Bill;
    }
     // build the message
    public function build(){
        return $this->subject('Xác nhận đơn hàng')
        ->markdown('clients.donhangs.mail')
        ->with('donHang', $this->bill);
    }
}
