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
        Schema::table('endorsements', function (Blueprint $table) {
            $table->timestamp('vendor_completed_at')->nullable();
            $table->timestamp('influencer_completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('endorsements', function (Blueprint $table) {
            $table->dropColumn(['vendor_completed_at', 'influencer_completed_at']);
        });
    }
};
