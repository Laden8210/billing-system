<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create Subscribers Table
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id('subscriber_id');
            $table->string('sr_fname');
            $table->string('sr_lname');
            $table->string('sr_minitial')->nullable();
            $table->string('sr_suffix')->nullable();
            $table->string('sr_contactnum');
            $table->string('sr_street');
            $table->string('sr_city');
            $table->string('sr_province');
            $table->string('sr_password');
            $table->string('sr_status');
            $table->timestamps();
        });

        // Create Subscription Areas Table
        Schema::create('subscriptionareas', function (Blueprint $table) {
            $table->id('subscriptionarea_id');
            $table->string('snarea_name');
            $table->timestamps();
        });

        // Create Subscription Plans Table
        Schema::create('subscriptionplans', function (Blueprint $table) {
            $table->id('subscriptionplan_id');
            $table->string('snplan_bandwidth');
            $table->decimal('snplan_fee', 8, 2);
            $table->timestamps();
        });

        // Create Subscriptions Table
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id('subscription_id');
            $table->unsignedBigInteger('subscriber_id');
            $table->unsignedBigInteger('subscriptionarea_id');
            $table->unsignedBigInteger('subscriptionplan_id');
            $table->string('sn_num');
            $table->date('sn_startdate');
            $table->string('sn_status');
            $table->timestamps();

            $table->foreign('subscriber_id')->references('subscriber_id')->on('subscribers')->onDelete('cascade');
            $table->foreign('subscriptionarea_id')->references('subscriptionarea_id')->on('subscriptionareas')->onDelete('cascade');
            $table->foreign('subscriptionplan_id')->references('subscriptionplan_id')->on('subscriptionplans')->onDelete('cascade');
        });

        // Create Notifications Table
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->unsignedBigInteger('subscriber_id');
            $table->string('nf_message');
            $table->date('nf_date');
            $table->string('nf_status');
            $table->timestamps();

            $table->foreign('subscriber_id')->references('subscriber_id')->on('subscribers')->onDelete('cascade');
        });

        // Create Billing Statements Table
        Schema::create('billingstatements', function (Blueprint $table) {
            $table->id('billstatement_id');
            $table->unsignedBigInteger('subscription_id');
            $table->decimal('bs_amount', 8, 2);
            $table->date('bs_billingdate');
            $table->date('bs_duedate');
            $table->string('bs_status');
            $table->timestamps();

            $table->foreign('subscription_id')->references('subscription_id')->on('subscriptions')->onDelete('cascade');
        });


        // Create Employees Table
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('em_fname');
            $table->string('em_lname');
            $table->string('em_minitial')->nullable();
            $table->string('em_suffix')->nullable();
            $table->string('em_contactnum');
            $table->string('em_password');
            $table->string('em_role');
            $table->string('em_status');
            $table->timestamps();
        });

        // Create Payments Table
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->unsignedBigInteger('billstatement_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('p_month');
            $table->decimal('p_amount', 8, 2);
            $table->date('p_date');
            $table->timestamps();

            $table->foreign('billstatement_id')->references('billstatement_id')->on('billingstatements')->onDelete('cascade');
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
        });

        // Create Remittances Table
        Schema::create('remittances', function (Blueprint $table) {
            $table->id('remittance_id');
            $table->decimal('rm_amount', 8, 2);
            $table->date('rm_date');
            $table->timestamps();

        });

        // Create Remittance Proofs Table
        Schema::create('remittanceproofs', function (Blueprint $table) {
            $table->id('remittanceproof_id');
            $table->unsignedBigInteger('remittance_id');
            $table->string('rm_proof');
            $table->timestamps();

            $table->foreign('remittance_id')->references('remittance_id')->on('remittances')->onDelete('cascade');
        });

        // Create Announcements Table
        Schema::create('announcements', function (Blueprint $table) {
            $table->id('announcement_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('an_subject');
            $table->text('an_message');
            $table->date('an_date');
            $table->timestamps();

            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
        });

        // Create Complaints Table
        Schema::create('complaints', function (Blueprint $table) {
            $table->id('complaint_id');
            $table->unsignedBigInteger('subscriber_id');
            $table->unsignedBigInteger('employee_id');
            $table->text('cp_message');
            $table->date('cp_date');
            $table->text('cp_reply')->nullable();
            $table->timestamps();

            $table->foreign('subscriber_id')->references('subscriber_id')->on('subscribers')->onDelete('cascade');
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('complaints');
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('remittanceproofs');
        Schema::dropIfExists('remittances');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('billingstatements');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('subscriptionplans');
        Schema::dropIfExists('subscriptionareas');
        Schema::dropIfExists('subscribers');
    }
};
