<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_num')->unique();
            $table->unsignedSmallInteger('file_type')->nullable();
            $table->unsignedSmallInteger('jofa_type')->nullable();
            $table->unsignedSmallInteger('status')->default(1); //Set Default Draft
            $table->timestamp('received_at')->nullable();
            $table->string('file_num')->nullable();
            $table->string('other_ref')->nullable(); //no geran tanah/pelan 
            $table->string('rack_num')->nullable(); //no geran tanah/pelan 
            $table->string('rfid')->nullable(); //no geran tanah/pelan 
            $table->unsignedInteger('approved_by')->nullable();
            $table->uuid('file_transaction_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('file_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('file_num');
            $table->string('rack_num');
            $table->string('rfid');
            $table->unsignedBigInteger('file_application_id');
            $table->enum('trx_type',['in','out']);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('file_applications', function (Blueprint $table){
            $table->foreign('approved_by')->references('id')->on('users');
            $table->foreign('file_transaction_id')->references('id')->on('file_transactions');
        });

        Schema::table('file_transactions', function (Blueprint $table){
            $table->foreign('file_application_id')->references('id')->on('file_applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('file_transactions',function (Blueprint $table){
            $table->dropForeign('file_transactions_file_application_id_foreign');
        });

        Schema::table('file_applications',function (Blueprint $table){
            $table->dropForeign('file_applications_file_transaction_id_foreign');
            $table->dropForeign('file_applications_approved_by_foreign');
        });

        Schema::dropIfExists('file_transactions');
        Schema::dropIfExists('file_applications');
    }
}
