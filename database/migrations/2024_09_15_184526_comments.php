<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Kolom primary key
            $table->text('comment'); // Kolom untuk menyimpan teks komentar
            $table->unsignedBigInteger('tickets_id'); // Kolom untuk foreign key
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan foreign key constraint
            $table->foreign('tickets_id')
                ->references('id')
                ->on('tickets')
                ->onDelete('cascade'); // Hapus komentar jika tiket dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
