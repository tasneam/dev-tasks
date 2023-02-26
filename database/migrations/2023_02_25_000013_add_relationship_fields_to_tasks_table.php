<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id', 'department_fk_8086231')->references('id')->on('departments');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id', 'project_fk_8086232')->references('id')->on('projects');
            $table->unsignedBigInteger('department_employees_id')->nullable();
            $table->foreign('department_employees_id', 'department_employees_fk_8088113')->references('id')->on('department_employees');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8088802')->references('id')->on('users');
        });
    }
}
