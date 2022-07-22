# Organizador de rotas em padrão especifico

Esse pacote é capaz de ler e cadastrar rotas de um sistema lumen em padrão especifico.

## Install

```bash
composer require duodoctor/setuprolepermission
```

Após a instalação registre o ServiceProvider no arquivo **./bootstrap/app.php**

`$app->register(\Duodoctor\Setuprolepermission\SetupRolePermissionServiceProvider::class);`

Com esse processo finalizado, ficará disponivel os seguintes comandos:

### Comandos

```bash
php artisan roleduodoctor:setup
```

Comando para ler as rotas e cadastra-las no sistema

```bash
php artisan roleduodoctor:proprietario
```

Comando para atribuir todas as rotas cadastradas para a permission **Proprietário**.