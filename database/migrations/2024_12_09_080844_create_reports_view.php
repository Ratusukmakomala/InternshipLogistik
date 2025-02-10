<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW reports AS
            SELECT t.id, t.receipt_number, t.transaction_date, t.first_delivery_date, t.receive_date, t.shipping_form, t.kind_delivery, t.`type`, t.delivery_type, t.weight, t.volume,
            t.item_value, t.base_price, t.note,
            t.tax_price, t.`status`, tcod.payment_date, tcod.payment_due_date, tcod.payment_status,
            sender.name AS sender_name, sender.phone AS sender_phone, sender.address AS sender_address, sender.zip_code AS sender_zip_code, receive.name AS receive_name, receive.phone AS receive_phone, receive.address AS receive_address, receive.zip_code AS receive_zip_code,
            sla.name, sla.target, t.sla_actual, t.sla_status
            FROM transactions t
            LEFT JOIN transaction_cash_on_deliveries AS tcod ON tcod.transaction_id = t.id
            LEFT JOIN transaction_customers AS tc ON tc.transaction_id = t.id
            JOIN service_level_agreements AS sla ON sla.id = t.sla_id
            LEFT JOIN customers AS sender ON sender.id = tc.sender_id
            LEFT JOIN customers AS receive ON receive.id = tc.receiver_id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS reports");
    }
};
