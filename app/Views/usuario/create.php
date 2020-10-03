<div class="row">
    <div class="col-sm text-left">
        <span class="page-title h4">Usuários</span>
    </div>
</div>
<hr>
<form action="<?= base_url('usuario/store') ?>" method="post">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Cadastre um usuário</div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control form-control-lg" id="nome" name="nome" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="tipoUsuario">Tipo de usuário</label>
                    <select class="form-control form-control-lg" id="tipoUsuario" name="tipoUsuario" required>
                        <option></option>
                        <?php foreach ($usuarioTipo as $tipo) : ?>
                            <option value="<?= $tipo['usuario_tipo_id'] ?>"><?= $tipo['nome'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control form-control-lg maskTelefone" maxlength="15" id="telefone" name="telefone">
                </div>
                <div class="form-group col-md-6">
                    <label for="nome">E-mail</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email">
                </div>
                <div class="form-group col-md-6">
                    <label for="login">Login</label>
                    <input type="text" class="form-control form-control-lg" id="login" name="login" minlength="4" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control form-control-lg" id="senha" name="senha" minlength="6" required>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Selecione as empresas</div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <table class="table table-striped">
                    <thead>
                        <th class="d-none d-md-block">#</th>
                        <th>Empresa</th>
                        <th class="text-center">Pertence</th>
                        <th class="text-center">Principal</th>
                    </thead>
                    <tbody>
                        <?php foreach($empresas as $empresa): ?>
                        <tr class="linhaTabela">
                            <td class="d-none d-md-block"><?= $empresa['empresa_id'] ?></td>
                            <td><?= $empresa['nome'] ?></td>
                            <td class="text-center"><input type="checkbox" class="empresas" name="empresas[]" data-toggle="toggle" data-onstyle="danger" value="<?= $empresa['empresa_id'] ?>"></td>
                            <td class="text-center"><input type="checkbox" class="empresaPrincipal" name="empresaPrincipal[]" data-toggle="toggle" data-onstyle="danger" value="<?= $empresa['empresa_id'] ?>"></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-right mb-2">
        <button class="btn btn-danger btn-lg" type="submit">Salvar</button>
        <?= csrf_field(); ?>
    </div>
</form>