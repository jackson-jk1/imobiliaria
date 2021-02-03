<?php


namespace App\Models;
use App\Models\Base\Model;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


/**
 * Class Administrador
 * @package App\Models
 */
class Email extends Model{
    private $para = null;
    private $assunto = null;
    private $mensagem = null;
    public $status =array('codigo_status' => null, 'descricao_status' => '');


    public function __get($atributo){
        return $this->$atributo;

    }

    public function __set($atributo, $valor){

        $this->$atributo = $valor;
    }
    public function mensagemValida()
    {

        if (empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
            return false;
        }
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = false;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = '';                 // SMTP username
            $mail->Password = '';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('nezukoimoveis@gmail.com', 'nezuko Imoveis');
            $mail->addAddress($this->__get('para'));// Add a recipient
            $mail->addReplyTo('nezukoimoveis@gmail.com', 'Information');
            $mail->isHTML(true);
            $mail->Subject = $this->__get('assunto');
            $mail->Body = $this->__get('mensagem');

            $mail->AltBody = 'deu bosta';

            $mail->send();


        } catch (Exception $e) {
            $this->view->msg = "Email informado invalido";
        }
    }
}
