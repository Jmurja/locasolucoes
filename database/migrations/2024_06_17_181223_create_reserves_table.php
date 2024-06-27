<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reserves', function(Blueprint $table) {
            $table->id();
            $table->foreignId(('user_id'))->constrained();
            $table->foreignId(('rental_item_id'))->constrained();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->longText('reserve_notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
