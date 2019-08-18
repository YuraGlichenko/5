<?php

require "vendor/autoload.php";

class swiftMailer
{
    public function senderEmail($userName, $userEmail)
    {
        try {
            $transport = (new Swift_SmtpTransport('smtp.yandex.ru', 465, 'ssl'))
                ->setUsername('gencoding@yandex.ru')
                ->setPassword('neverwinter1');
            $mailer = new Swift_Mailer($transport);
            $message = new Swift_Message('Поздравляем!');
            $message->setFrom('gencoding@yandex.ru');
            $message->setTo("$userEmail");
            $message->setBody("Поздравляем! $userName. Вы зарегистрировались в службе доставки Burger$");
            $ret = $mailer->send($message);

            if ($ret) {
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }


    }
}