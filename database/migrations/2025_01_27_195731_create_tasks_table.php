<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
            Schema::create('tasks', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('title');
                $table->text('description')->nullable();
                $table->enum('priority', ['low', 'medium', 'high'])->default('low');
                $table->enum('status', ['pending', 'completed'])->default('pending');
                $table->date('deadline')->nullable();
                $table->timestamps();
                $table->index('created_at');
            });
    }
    
    

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
