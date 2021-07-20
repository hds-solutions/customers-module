<?php

use HDSSolutions\Laravel\Blueprints\BaseBlueprint as Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // get schema builder
        $schema = DB::getSchemaBuilder();

        // replace blueprint
        $schema->blueprintResolver(fn($table, $callback) => new Blueprint($table, $callback));

        // create table
        $schema->create('people', function(Blueprint $table) {
            $table->id();
            $table->foreignTo('Company');
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('documentno');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender', [ 'male', 'female' ])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('people');
    }

}
