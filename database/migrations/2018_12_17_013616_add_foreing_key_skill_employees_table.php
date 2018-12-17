<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeySkillEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees_skills', function (Blueprint $table) {
            $table->foreign('id_employee')
                ->references('id')->on('employees')
                ->onDelete('cascade');

            $table->foreign('id_skill')
                ->references('id')->on('skills')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees_skills', function (Blueprint $table) {
            //
        });
    }
}
