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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->foreignIdFor(App\Models\User::class) // nullable to make it optional (not every user will offer jobs)
            ->nullable()->constrained(); // make sure to call nullable() before constrained()
            $table->timestamps();
        });
        Schema::table('jobs',function(Blueprint $table){
            $table->foreignIdFor(App\Models\Employer::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('jobs',function(Blueprint $table){
           $table->dropForeignIdFor(App\Models\Employer::class);
        });
        Schema::dropIfExists('employers');
    }
};
