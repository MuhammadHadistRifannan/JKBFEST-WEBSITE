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

     
        //
        Schema::create('teams' , function(Blueprint $table){
            $table->id();
            $table
            ->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete();
            
            $table->string('advisor_name');
            $table->string('advisor_phone');
            
            $table->string('team_name');
            $table->string('institution');
            $table->boolean('status_team');

        });

           Schema::create('document', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('team_id')
            ->constrained('teams')
            ->cascadeOnDelete();
            $table->string('document_path');
            $table->enum('status_document', ['pending', 'approved', 'rejected']);
        });

        Schema::create('team_members' , function(Blueprint $table){
            $table->id();
            $table
            ->foreignId('team_id')
            ->constrained('teams')
            ->cascadeOnDelete();

            $table->string('name');
            $table->string('phone');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('team_members');
        Schema::dropIfExist('document');
        Schema::dropIfExists('teams');
    }
};
