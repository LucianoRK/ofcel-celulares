<div class="row">
    <div class="col-sm text-left">
        <span class="page-title h4">Clientes</span>
    </div>
</div>
<hr>
<form action="<?= base_url('cliente/store') ?>" method="post">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Cadastre um cliente</div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="documento" class="cpfCnpjTroca">CPF</label>
                    <input type="text" class="form-control form-control-lg cpf cpfCnpj" maxlength="20" id="documento" name="documento" >
                </div>
                <div class="form-group col-md-6">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control form-control-lg" id="nome" name="nome" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control form-control-lg maskTelefone" maxlength="15" id="telefone" name="telefone">
                </div>
                <div class="form-group col-md-4">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email">
                </div>
                <div class="form-group col-md-4">
                    <label for="dataNascimento">Data Nascimento</label>
                    <input type="date" class="form-control form-control-lg" id="dataNascimento" name="dataNascimento">
                </div>
                <div class="form-group col-md-12">
                    <label for="rua">Observações</label>
                    <textarea class="form-control form-control-lg" id="observacao" name="observacao"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Endereço do cliente</div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="cep">CEP</label>
                    <input type="text" class="form-control form-control-lg maskCep" id="cep" name="cep" maxlength="12">
                </div>
                <div class="form-group col-md-6">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control form-control-lg" id="cidade" name="cidade" >
                </div>
                <div class="form-group col-md-2">
                    <label for="uf">UF</label>
                    <input type="text" class="form-control form-control-lg" id="uf" name="uf" maxlength="2">
                </div>
                <div class="form-group col-md-4">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control form-control-lg" id="bairro" name="bairro">
                </div>
                <div class="form-group col-md-6">
                    <label for="rua">Rua</label>
                    <input type="text" class="form-control form-control-lg" id="rua" name="rua">
                </div>
                <div class="form-group col-md-2">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control form-control-lg numero" id="numero" name="numero">
                </div>
                <div class="form-group col-md-12">
                    <label for="rua">Complemento</label>
                    <textarea class="form-control form-control-lg" id="complemento" name="complemento"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mb-2">
        <button class="btn btn-danger btn-lg" type="submit">Salvar</button>
        <?= csrf_field(); ?>
    </div>
</form>