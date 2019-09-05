<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->string('nome_razao',250);
            $table->string('sobrenome_fantasia',250);
            $table->string('cpf_cnpj',25);
            $table->string('rg_ie',25);
            $table->enum('tipo_pessao', ['0', '1'])->default('0')->comment('0-> Pessoa Física, 1-> Pessoa Juridíca');

            /**  Pessoa Fisica */
            $table->enum('status', ['A', 'I'])->default('A')->comment('A-> Ativo, I-> Inativo');
            $table->enum('marital_status', ['0','1','2','3','4','5','6'])
                ->comment('0-> Não Informado, 1-> Solteiro, 2-> Casado, 3-> Desquitado, 4->Viúvo, 5-> União Estável, 6-> Outros')
                ->nullable();
            $table->date('birth_date_fundacao')->nullable();
            $table->enum('sex', ['N', 'M', 'F'])->comment('N-> Não Informado, M-> Masculino, F-> Feminino')->nullable();

            /**  Endereço principal */
            $table->string('cep_res',9);
            $table->string('uf_res',2);
            $table->string('cidade_res',100);
            $table->string('bairro_res',100);
            $table->string('lougradouro_res',100);
            $table->string('numero_res',50);
            $table->string('complemento_res',250);
            $table->string('ponto_referencia_res',250);
            $table->integer('ibge_cidade_id_res');

            /**  Endereço comercial */
            $table->string('cep_com',9);
            $table->string('uf_com',2);
            $table->string('cidade_com',100);
            $table->string('bairro_com',100);
            $table->string('lougradouro_com',100);
            $table->string('numero_com',50);
            $table->string('complemento_com',250);
            $table->string('ponto_referencia_com',250);
            $table->integer('ibge_cidade_id_com');

            /**  Endereço correspondencia */
            $table->string('cep_cor',9);
            $table->string('uf_cor',2);
            $table->string('cidade_cor',100);
            $table->string('bairro_cor',100);
            $table->string('lougradouro_cor',100);
            $table->string('numero_cor',50);
            $table->string('complemento_cor',250);
            $table->string('ponto_referencia_cor',250);
            $table->integer('ibge_cidade_id_cor');

            /**  Contatos */
            $table->string('email',100)->nullable();
            $table->string('email_a',100)->nullable();
            $table->string('fone_principal',14)->nullable();
            $table->string('fone_cell_1',14)->nullable();
            $table->string('fone_cell_2',14)->nullable();
            $table->string('fone_comercial',14)->nullable();
            $table->string('fone_fax',14)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
