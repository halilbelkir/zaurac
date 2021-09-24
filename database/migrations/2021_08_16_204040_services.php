<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Query\Expression;

    class Services extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('content');
                $table->string('tag');
                $table->string('description');
                $table->string('seflink')->unique();
                $table->integer('order')->default('99');
                $table->smallInteger('homepage')->default('0');
                $table->text('images')->nullable()->default(new Expression('(JSON_ARRAY())'));
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
            //
        }
    }
