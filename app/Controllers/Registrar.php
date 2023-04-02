<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsuarioModel;

class Registrar extends BaseController
{
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new \App\Models\UsuarioModel();
    }

    use ResponseTrait;
 
    public function index()
    {
        $rules = [
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'passwor_confirmation'  => [ 'label' => 'confirm password', 'rules' => 'matches[password]']
        ];
            
  
        if($this->validate($rules)){
            $model = new UserModel();
            $data = [
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
             
            return $this->respond(['message' => 'Registered Successfully'], 200);
        }else{
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response , 409);
             
        }
            
    }

    public function novo()
    {
        $data = [
            'titulo' => 'Criar nova conta',
        ];

        return view('Registrar/novo', $data);
    }

    public function criar()
    {
        if ($this->request->getMethod() == 'post') {

            $usuario = new \App\Entities\Usuario($this->request->getPost());

            $this->usuarioModel->desabilitaValidacaoTelefone();

            $usuario->iniciaAtivacao();

            if ($this->usuarioModel->insert($usuario)) {

                $this->enviaEmailParaAtivarConta($usuario);
                
                return redirect()->to(site_url('registrar/ativacaoenviado'));

            } else {
                return redirect()->back()->with('errors_model', $this->usuarioModel->errors())
                                        ->with('atencao', "Por favor verifique os erros abaixo.")
                                        ->withInput();
            }


        } else {
            return redirect()->back();
        }
    }

    public function ativacaoEnviado() 
    {
        $data = [
            'titulo' => 'E-mail de ativação da conta enviado para a sua caixa de entrada.',
        ];

        return view('Registrar/ativacao_enviado', $data);
    }

    public function ativar(string $token) 
    {
        if ($token == null) {
            return redirect()->to(site_url('login'));
        }

        $this->usuarioModel->ativarContaPeloToken($token);

        return redirect()->to(site_url('login'))->with('sucesso', 'Conta ativada com sucesso.');
    }

    private function enviaEmailParaAtivarConta(object $usuario) {

        $email = \Config\Services::email();

        $email->setFrom('no-reply@delivery.com.br', 'Food Delivery');
        $email->setTo($usuario->email);

        $email->setSubject('Ativação de conta.');
        
        $mensagem = view('Registrar/ativacao_email', ['usuario' => $usuario]);

        $email->setMessage($mensagem);

        $email->send();
    }
}
