<?php

use App\Models\BillingStatement;
use App\Models\Payment;
use App\Models\Role;
use App\Models\Subscriber;
use App\Models\Employee;
use App\Models\Remittance;
use App\Models\SubscriptionArea;
use App\Models\SubscriptionPlan;
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
        Schema::create('subscriber', function (Blueprint $table) {
            $table->id('subscriber_id');
            $table->string('contact_number', 20);
            $table->string('firstname', 64);
            $table->string('lastname', 64);
            $table->string('middlleinitial', 1);
            $table->string('sufix', 10);
            $table->string('password', 255);
            $table->string('status', 11);
        });

        Schema::create('role', function (Blueprint $table) {
            $table->id('role_id');
            $table->string('role_name',64);
        });

        Schema::create('employee', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('contact_number', 20);
            $table->string('firstname', 64);
            $table->string('lastname', 64);
            $table->string('middlleinitial', 1);
            $table->string('sufix', 10);
            $table->string('password', 255);
            $table->string('status', 11);
            $table->foreignIdFor(Role::class);
        });



        Schema::create('notification', function (Blueprint $table) {
            $table->id('Notification_id');
            $table->string('message_Text', 255);
            $table->date('date_created',64);
            $table->string('status',20);

            $table->foreignIdFor(Subscriber::class);

        });
        Schema::create('subscription_area', function (Blueprint $table) {
            $table->id('subcription_area_id');
            $table->string('area_name');
        });
        Schema::create('subscription_plan', function (Blueprint $table) {
            $table->id('subscription_plan_id');
            $table->string('bandwith',255);
            $table->string('subscription_fee',64);
        });
        Schema::create('complaints', function (Blueprint $table) {
            $table->id('complaint_id');
            $table->string('complaint_message',255);
            $table->date('date_created',64);
            $table->string('reply',255);
            $table->foreignIdFor(Subscriber::class);
        });


        Schema::create('announcement', function (Blueprint $table) {
            $table->id('announcement_id');
            $table->string('subject',64);
            $table->string('announcement_message',255);
            $table->date('date_created',64);
        });
        Schema::create('subscription', function (Blueprint $table) {
            $table->id('subscription_id');
            $table->string('contact_number', 20);
            $table->string('firstname', 64);
            $table->string('lastname', 64);
            $table->string('middlleinitial', 1);
            $table->string('sufix', 10);
            $table->string('street', 255);
            $table->string('city', 255);
            $table->string('province', 255);
            $table->date('startdate', 255);
            $table->string('status', 11);
            $table->foreignIdFor(SubscriptionPlan::class);
            $table->foreignIdFor(SubscriptionArea::class);
            $table->foreignId(Subscriber::class);
        });
        Schema::create('billing_statement', function (Blueprint $table) {
            $table->id('billing_statement_id');
            $table->string('amount_due', 64);
            $table->date('billing_date', 11);
            $table->date('due_date', 11);
            $table->string('status', 11);
            $table->foreignIdFor(Subscriber::class);
        });
        Schema::create('payment', function (Blueprint $table) {
            $table->id('payment_id');
            $table->string('month_paid', 64);
            $table->date('amount_paid', 11);
            $table->date('date_created', 11);
            $table->string('status', 11);
            $table->foreignId(BillingStatement::class);
            $table->foreignIdFor(Employee::class);
        });
        Schema::create('temporary_reciept', function (Blueprint $table) {
            $table->id('temporary_reciept_id');
            $table->string('temp_receipt_number',64);
            $table->string('amount_paid',255);
            $table->date('payment_date',64);
            $table->foreignId(Payment::class);
        });
        Schema::create('remittance', function (Blueprint $table) {
            $table->id('remittance_id');
            $table->decimal('remittance_amount',64);
            $table->date('date_created',64);
            $table->foreignId(Payment::class);
        });
        Schema::create('remittanceprof', function (Blueprint $table) {
            $table->id('remittance_prof_id');
            $table->longText('ImageFile')->charset('binary');
            $table->foreignIdFor(Remittance::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriber');
        Schema::dropIfExists('notification');
        Schema::dropIfExists('subscription_area');
        Schema::dropIfExists('subscription_plan');
        Schema::dropIfExists('complaints');
        Schema::dropIfExists('role');
        Schema::dropIfExists('employee');
        Schema::dropIfExists('announcement');
        Schema::dropIfExists('subscription');
        Schema::dropIfExists('billing_statement');
        Schema::dropIfExists('payment');
        Schema::dropIfExists('temporary_reciept');
        Schema::dropIfExists('remittance');
        Schema::dropIfExists('remittanceprof');

    }
};
