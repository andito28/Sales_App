<?php

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailClass extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The email data
     *
     * @var array
     */
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = new PHPMailer(true);

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'ssl://mail.ewalabs.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'demoapp@ewalabs.com';
        $mail->Password = 'demoewalabs2017';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('demoapp@ewalabs.com', 'Ewalabs');
        $mail->addAddress($this->data['email'], $this->data['name']);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $this->data['subject'];
        $mail->Body = $this->data['message'];

        return $this->view('forgetPasswordMail')->with('data', $this->data);
    }
}
