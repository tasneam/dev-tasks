<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentEmployeeRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('department_employee_role', function (Blueprint $table) {
            $table->unsignedBigInteger('department_employee_id');
            $table->foreign('department_employee_id', 'department_employee_id_fk_8088102')->references('id')->on('department_employees')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_8088102')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
