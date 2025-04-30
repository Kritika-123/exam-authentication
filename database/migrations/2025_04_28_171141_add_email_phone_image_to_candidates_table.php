<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            // Check if the column does not already exist
            if (!Schema::hasColumn('candidates', 'phone')) {
                $table->string('phone')->nullable(); 
            }

            if (!Schema::hasColumn('candidates', 'email')) {
                $table->string('email')->unique()->nullable();
            }

            if (!Schema::hasColumn('candidates', 'photo')) {
                $table->string('photo')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn(['phone', 'email', 'photo']);
        });
    }
};
