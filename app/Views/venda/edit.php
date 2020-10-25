<div class="row">
    <div class="col-sm text-left">
        <span class="page-title h4">Usuários</span>
    </div>
</div>
<hr>
<form action="<?= base_url('usuario/update/' . $usuario['usuario_id']) ?>" method="post">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Editar usuário <?= $usuario['nome'] ?></div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control form-control-lg" id="nome" name="nome" value="<?= $usuario['nome'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="tipoUsuario">Tipo de usuário</label>
                    <select class="form-control form-control-lg" id="tipoUsuario" name="tipoUsuario" required>
                        <option></option>
                        <?php foreach ($usuarioTipo as $tipo) : ?>
                            <option value="<?= $tipo['usuario_tipo_id'] ?>" <?= $usuario['usuario_tipo_id'] == $tipo['usuario_tipo_id'] ? 'selected' : ''; ?>><?= $tipo['nome'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control form-control-lg maskTelefone" maxlength="15" id="telefone" name="telefone" value="<?= $usuario['telefone'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="nome">E-mail</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email" value="<?= $usuario['email'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="login">Login</label>
                    <input type="text" class="form-control form-control-lg" id="login" name="login" minlength="4" required value="<?= $usuario['login'] ?>">
                    <input type="hidden" class="form-control form-control-lg" id="loginAtual" name="loginAtual" value="<?= $usuario['login'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="senha">Senha <small>(será alterada apenas se preenchida)</small></label>
                    <input type="password" class="form-control form-control-lg" id="senha" name="senha">
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
                        <?php foreach ($empresas as $key => $empresa) : ?>
                            <tr class="linhaTabela">
                                <td class="d-none d-md-block"><?= $empresa['empresa_id'] ?></td>
                                <td><?= $empresa['nome'] ?></td>
                                <?php
                                //Seta o checked como false
                                $checkedEmpresa   = false;
                                $checkedPrincipal = false;
                                //Percorre pela empresa do usuario
                                foreach ($usuarioEmpresas as $usuarioEmpresa) {
                                    //Se encontrar a informação nos 2 arrays marca como checked
                                    if ($empresa['empresa_id'] == $usuarioEmpresa['empresa_id']) {
                                        $checkedEmpresa = true;
                                        if ($usuarioEmpresa['principal'] == '1') {
                                            $checkedPrincipal = true;
                                        }
                                    }
                                }
                                ?>
                                <td class="text-center"><input type="checkbox" class="empresas" name="empresas[]" data-toggle="toggle" data-onstyle="danger" value="<?= $empresa['empresa_id'] ?>" <?= $checkedEmpresa ? 'checked' : ''; ?>></td>
                                <td class="text-center"><input type="checkbox" class="empresaPrincipal" name="empresaPrincipal[]" data-toggle="toggle" data-onstyle="danger" value="<?= $empresa['empresa_id'] ?>" <?= $checkedPrincipal ? 'checked' : ''; ?>></td>
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