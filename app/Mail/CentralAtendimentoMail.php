<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CentralAtendimentoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mensagem;
    public $email;
    public $name;
    public $assunto;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensagem,$email, $name,$assunto)
    {
        $this->mensagem = $mensagem;
        $this->email = $email;
        $this->name = $name;
        $this->assunto = $assunto;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject:$this->assunto,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.central_atendimento.index',
            with: [
                'assunto' => $this->assunto,
                'email'=> $this->email,
                'name'=> $this->name,
                'mensagem'=> $this->mensagem,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
