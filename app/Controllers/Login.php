<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsuarioModel;
use \Firebase\JWT\JWT;

class Login extends BaseController
{
    use ResponseTrait;
      
    public function index()
    {
        $usuarioModel = new UsuarioModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $autenticacao = service('autenticacao');
            
        if ($autenticacao->login($email, $password)) {
            $usuario = $autenticacao->pegaUsuarioLogado();
        } else {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }
   
        // $user = $usuarioModel->where('email', $email)->first();
   
        // if(is_null($usuario)) {
        //     return $this->respond(['error' => 'Invalid username or password.'], 401);
        // }
   
        // $pwd_verify = password_verify($password, $usuario->password_hash);
   
        // if(!$pwd_verify) {
        //     return $this->respond(['error' => 'Invalid username or password.'], 401);
        // }
  
        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;
  
        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "email" => $usuario->email,
        );
          
        $token = JWT::encode($payload, $key, 'HS256');
  
        $response = [
            'message' => 'Login Succesful',
            'token' => $token
        ];
          
        return $this->respond($response, 200);
    }

    public function novo()
    {
        
        $data = [
            'titulo'     => 'Realize o login',
        ];

        return view('Login/novo', $data);
    }

    public function criar()
    {
        
        if ($this->request->getMethod('post')) {
            
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $autenticacao = service('autenticacao');
            
            if ($autenticacao->login($email, $password)) {
                $usuario = $autenticacao->pegaUsuarioLogado();

                if (!$usuario->is_admin) {

                    if (session()->has('carrinho')) {
                        return redirect()->to(site_url('checkout'));
                    }

                    return redirect()->to(site_url('/'));
                }
                
                return redirect()->to(site_url('admin/home'))->with('sucesso', "Olá $usuario->nome, que bom que está de volta!");
            } else {
                return redirect()->back()->with('atencao', "Não encontramo suas credenciais de acesso!");
            }

        } else {
            return redirect()->back();
        }
    }

    /**
     * Para que possamos exibir a mensagem de 'Sua sessão expirou.',
     * Após o logout, devemos fazer uma requisição para uma URL, nesse caso a 'mostraMensagemLogout'
     * Pois quando fazemos o Logout, todos os dados da sessão atual, incluindo os flashdata são destruídos.
     * Ou seja, as mensagens nunca serão exibidas.
     * 
     * Poratanto, para conseguirmos exibí-la, basta criarmos o método 'mostraMensagemLogout' que fará o redirect para a Home,
     * Com a mensagem desejada.
     * 
     * E como se trata de um redirect, a mensagem só será exibida uma vez.
     */
    public function logout() {

        service('autenticacao')->logout();
 
        return redirect()->to(site_url('login/mostraMensagemLogout'));
    }

    public function mostraMensagemLogout() {

        return redirect()->to(site_url('login/novo'))->with('info', 'Esperamos ver você novamente.');
    }
}
