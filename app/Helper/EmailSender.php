<?php

namespace App\Helper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class EmailSender
{
    private static $mail;

    public static function init()
    {
        if (!self::$mail) {
            self::$mail = new PHPMailer(true);
            self::$mail->isSMTP();
            self::$mail->Host = getenv('MAIL_HOST');
            self::$mail->SMTPAuth = true;
            self::$mail->Username = getenv('MAIL_USERNAME');
            self::$mail->Password = getenv('MAIL_PASSWORD');
            self::$mail->SMTPSecure = getenv('MAIL_ENCRYPTION');
            self::$mail->Port = getenv('MAIL_PORT');
            self::$mail->setFrom(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'));
        }
    }

    /**
     * Send an email.
     *
     * @param string $toRecipient Email address of the recipient.
     * @param string $subject Subject of the email.
     * @param string $body HTML content of the email.
     * @return bool True on success, false on failure.
     */
    public static function sendEmail($toRecipient, $subject, $body)
    {
        self::init();

        // try {
            self::$mail->addAddress($toRecipient);
            self::$mail->isHTML(true);
            self::$mail->Subject = $subject;
            self::$mail->Body = $body;
            self::$mail->AltBody = strip_tags($body);

            self::$mail->send();
            return true;
        // } catch (Exception $e) {
        //     // Optionally log the error message
        //     return false;
        // }
    }
}