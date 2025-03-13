<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Sessions;


class CorreoEntradas extends Mailable
{
    use Queueable, SerializesModels;
    public $seats;
    public $cliente;
    public $session;
    public $totalPrice;

    public function __construct($seats, $cliente, $id_session, $totalPrice)
    {
        $this->seats = $seats;
        $this->cliente = $cliente;
        $this->session = Sessions::find($id_session);
        // $response = json_decode($totalPrice, true);
        // $this->totalPrice = $response['total'];
    }

    public function build()
    {
        return $this->view('mail.resumTickets');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de Compra en CineVilla',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.resumTickets',
        );
    }
}
