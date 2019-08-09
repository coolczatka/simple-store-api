<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->createViews()[0]);
        DB::statement($this->createViews()[1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropViews()[0]);
        DB::statement($this->dropViews()[1]);
    }

    private function createViews(){
        return [
        "CREATE OR REPLACE VIEW bestsellingproduct AS
        SELECT products.name,
        count(orders.product_id) AS total
        FROM orders
        JOIN products ON products.id = orders.product_id
        WHERE date(orders.created_at) = (CURRENT_DATE - '1 day'::interval)
        GROUP BY orders.product_id, products.name
        ORDER BY (count(orders.product_id)) DESC
        LIMIT 1;",

        "CREATE OR REPLACE VIEW sum_of_yesterday AS
        SELECT sum(pr.price) AS sum
        FROM products pr
        JOIN orders o ON o.product_id = pr.id
        WHERE date(o.created_at) = (CURRENT_DATE - '1 day'::interval);"];
    }
    private function dropViews(){
        return[
        "DROP VIEW bestsellingproduct CASCADE;",
        "Drop view sum_of_yesterday CASCADE;"];
SQL;

    }
}
