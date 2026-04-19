<?php
namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Mailer — sends emails using PHPMailer over SMTP.
 *
 * Configure these variables in your .env file:
 *   MAIL_HOST, MAIL_PORT, MAIL_USER, MAIL_PASS, MAIL_FROM, MAIL_FROM_NAME
 *
 * For development, use Mailtrap (mailtrap.io) to catch test emails.
 */
class Mailer {
    /**
     * Send an email.
     *
     * @param string $to      Recipient email address
     * @param string $subject Email subject line
     * @param string $body    Email body text
     * @param bool   $isHtml  Whether the body is HTML (default: plain text)
     * @return bool  True if sent successfully, false on failure
     */
    public static function send(string $to, string $subject, string $body, bool $isHtml = false): bool {
        $mail = new PHPMailer(true);

        try {
            // SMTP settings from .env
            $mail->isSMTP();
            $mail->Host       = getenv('MAIL_HOST') ?: 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = getenv('MAIL_USER') ?: '';
            $mail->Password   = getenv('MAIL_PASS') ?: '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = (int)(getenv('MAIL_PORT') ?: 2525);

            // Sender and recipient
            $mail->setFrom(
                getenv('MAIL_FROM') ?: 'hello@example.com',
                getenv('MAIL_FROM_NAME') ?: 'AuthBoard'
            );
            $mail->addAddress($to);

            // Content
            $mail->isHTML($isHtml);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log('Mailer Error: ' . $mail->ErrorInfo);
            return false;
        }
    }
}
