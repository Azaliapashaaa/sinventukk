<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Comment out or remove the entire 'up' method
        /*
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('merk', 50)->nullable();
            $table->string('seri', 50)->nullable();
            $table->text('spesifikasi')->nullable();
            $table->smallInteger('stok')->default(0);
            $table->tinyInteger('kategori_id')->unsigned();

            $table->foreign('kategori_id')->references('id')->on('kategori')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->timestamps();
        });
        */
    }

    public function down(): void
    {
        // Define the 'down' method to drop the 'barang' table if needed
        Schema::dropIfExists('barang');
    }
};
