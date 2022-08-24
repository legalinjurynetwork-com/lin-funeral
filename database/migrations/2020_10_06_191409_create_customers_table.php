<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign_id')->unsigned();
            $table->string('billing_address1');
            $table->string('billing_address2');
            $table->string('billing_first_name');
            $table->string('billing_last_name');
            $table->string('billing_city');
            $table->string('billing_region');
            $table->string('billing_postal_code');
            $table->string('billing_country');
            $table->string('shipping_address1');
            $table->string('shipping_address2');
            $table->string('shipping_first_name');
            $table->string('shipping_last_name');
            $table->string('shipping_city');
            $table->string('shipping_region');
            $table->string('shipping_postal_code');
            $table->string('shipping_country');
            $table->string('ip_address');
            $table->string('email_address');
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
