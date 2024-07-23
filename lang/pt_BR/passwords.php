Claro! Aqui está a tradução para português das linhas de redefinição de senha no Laravel:

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | As seguintes linhas de linguagem são as linhas padrão que correspondem
    | aos motivos fornecidos pelo corretor de senha para uma tentativa de
    | atualização de senha falhar, como devido a um token de redefinição
    | inválido ou senha inválida.
    |
    */

    'reset'     => 'Sua senha foi redefinida.',
    'sent'      => 'Enviamos um link de redefinição de senha para o seu email.',
    'throttled' => 'Por favor, aguarde antes de tentar novamente.',
    'token'     => 'Este token de redefinição de senha é inválido.',
    'user'      => "Não conseguimos encontrar um usuário com esse endereço de email.",

];
