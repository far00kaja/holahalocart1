<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeysForKategoriProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kategori_produk', function (Blueprint $table) {
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kategori_produk', function (Blueprint $table) {
            $table->dropForeign('kategori_produk_kategori_id_foreign');
            $table->dropForeign('kategori_produk_produk_id_foreign');
        });

        // Schema::dropIfExists('foreign_keys_for_produk_kategori');
    }
}
