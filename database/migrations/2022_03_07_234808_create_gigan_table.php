<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGiganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('challenges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('challenger_id')->index('challenger_id');
            $table->unsignedBigInteger('challenged_id')->index('challenged_id');
            $table->unsignedBigInteger('week_id')->index('week_id');
            $table->unsignedBigInteger('winner_id')->index('winner_id');
            $table->timestamp('challenged_at');
            $table->unsignedSmallInteger('challenger_rank');
            $table->unsignedBigInteger('challenged_rank');
            $table->string('video');
            $table->timestamp('created_at')->useCurrent();
            $table->unsignedBigInteger('created_by')->default('1')->index('created_by');
            $table->timestamp('updated_at')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable()->index('updated_by');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->index('deleted_by');
        });

        Schema::create('flexers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('orkID');
            $table->unsignedSmallInteger('rank');
            $table->timestamp('created_at')->useCurrent();
            $table->unsignedBigInteger('created_by')->default('1')->index('created_by');
            $table->timestamp('updated_at')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable()->index('updated_by');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->index('deleted_by');
        });

        Schema::create('kingdoms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->text('description');
            $table->string('image')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->unsignedBigInteger('created_by')->default('1')->index('created_by');
            $table->timestamp('updated_at')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable()->index('updated_by');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->index('deleted_by');
        });

        Schema::create('lands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kingdom_id')->index('kingdom_id');
            $table->string('label');
            $table->text('description');
            $table->string('image')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->unsignedBigInteger('created_by')->default('1')->index('created_by');
            $table->timestamp('updated_at')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable()->index('updated_by');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->index('deleted_by');
        });

        Schema::create('weeks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
        });

        Schema::table('challenges', function (Blueprint $table) {
            $table->foreign(['challenged_id'], 'challenges_challenged_id')->references(['id'])->on('flexers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['challenger_id'], 'challenges_challenger_id')->references(['id'])->on('flexers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['created_by'], 'challenges_created_by')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['deleted_by'], 'challenges_deleted_by')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['updated_by'], 'challenges_updated_by')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['week_id'], 'challenges_week_id')->references(['id'])->on('weeks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['winner_id'], 'challenges_winner_id')->references(['id'])->on('flexers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('flexers', function (Blueprint $table) {
            $table->foreign(['created_by'], 'flexers_created_by')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['deleted_by'], 'flexers_deleted_by')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['updated_by'], 'flexers_updated_by')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('kingdoms', function (Blueprint $table) {
            $table->foreign(['created_by'], 'kingdoms_created_by')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['deleted_by'], 'kingdoms_deleted_by')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['updated_by'], 'kingdoms_updated_by')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('lands', function (Blueprint $table) {
            $table->foreign(['created_by'], 'lands_created_by')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['deleted_by'], 'lands_deleted_by')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['kingdom_id'], 'lands_kingdom_id')->references(['id'])->on('kingdoms')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['updated_by'], 'lands_updated_by')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        DB::table('weeks')->insert([
			'id' => 1,
			'starts_at' => '2021-08-09 00:00:00',
			'ends_at' => '2021-08-15 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 2,
			'starts_at' => '2021-08-16 00:00:00',
			'ends_at' => '2021-08-22 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 3,
			'starts_at' => '2021-08-23 00:00:00',
			'ends_at' => '2021-08-29 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 4,
			'starts_at' => '2021-08-30 00:00:00',
			'ends_at' => '2021-09-05 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 5,
			'starts_at' => '2021-09-06 00:00:00',
			'ends_at' => '2021-09-12 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 6,
			'starts_at' => '2021-09-13 00:00:00',
			'ends_at' => '2021-09-19 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 7,
			'starts_at' => '2021-09-20 00:00:00',
			'ends_at' => '2021-09-26 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 8,
			'starts_at' => '2021-09-27 00:00:00',
			'ends_at' => '2021-10-03 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 9,
			'starts_at' => '2021-10-04 00:00:00',
			'ends_at' => '2021-10-10 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 10,
			'starts_at' => '2021-10-11 00:00:00',
			'ends_at' => '2021-10-17 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 11,
			'starts_at' => '2021-10-18 00:00:00',
			'ends_at' => '2021-10-24 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 12,
			'starts_at' => '2021-10-25 00:00:00',
			'ends_at' => '2021-10-31 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 13,
			'starts_at' => '2021-11-01 00:00:00',
			'ends_at' => '2021-11-07 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 14,
			'starts_at' => '2021-11-08 00:00:00',
			'ends_at' => '2021-11-14 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 15,
			'starts_at' => '2021-11-15 00:00:00',
			'ends_at' => '2021-11-21 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 16,
			'starts_at' => '2021-11-22 00:00:00',
			'ends_at' => '2021-11-28 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 17,
			'starts_at' => '2021-11-29 00:00:00',
			'ends_at' => '2021-12-05 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 18,
			'starts_at' => '2021-12-06 00:00:00',
			'ends_at' => '2021-12-12 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 19,
			'starts_at' => '2021-12-13 00:00:00',
			'ends_at' => '2021-12-19 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 20,
			'starts_at' => '2021-12-20 00:00:00',
			'ends_at' => '2021-12-26 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 21,
			'starts_at' => '2021-12-27 00:00:00',
			'ends_at' => '2022-01-02 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 22,
			'starts_at' => '2022-01-03 00:00:00',
			'ends_at' => '2022-01-09 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 23,
			'starts_at' => '2022-01-10 00:00:00',
			'ends_at' => '2022-01-16 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 24,
			'starts_at' => '2022-01-17 00:00:00',
			'ends_at' => '2022-01-23 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 25,
			'starts_at' => '2022-01-24 00:00:00',
			'ends_at' => '2022-01-30 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 26,
			'starts_at' => '2022-01-31 00:00:00',
			'ends_at' => '2022-02-06 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 27,
			'starts_at' => '2022-02-07 00:00:00',
			'ends_at' => '2022-02-13 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 28,
			'starts_at' => '2022-02-14 00:00:00',
			'ends_at' => '2022-02-20 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 29,
			'starts_at' => '2022-02-21 00:00:00',
			'ends_at' => '2022-02-27 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 30,
			'starts_at' => '2022-02-28 00:00:00',
			'ends_at' => '2022-03-06 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 31,
			'starts_at' => '2022-03-07 00:00:00',
			'ends_at' => '2022-03-13 23:59:59'
		]);
		DB::table('weeks')->insert([
			'id' => 32,
			'starts_at' => '2022-03-14 00:00:00',
			'ends_at' => '2022-03-20 23:59:59'
		]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lands', function (Blueprint $table) {
            $table->dropForeign('lands_created_by');
            $table->dropForeign('lands_deleted_by');
            $table->dropForeign('lands_kingdom_id');
            $table->dropForeign('lands_updated_by');
        });

        Schema::table('kingdoms', function (Blueprint $table) {
            $table->dropForeign('kingdoms_created_by');
            $table->dropForeign('kingdoms_deleted_by');
            $table->dropForeign('kingdoms_updated_by');
        });

        Schema::table('flexers', function (Blueprint $table) {
            $table->dropForeign('flexers_created_by');
            $table->dropForeign('flexers_deleted_by');
            $table->dropForeign('flexers_updated_by');
        });

        Schema::table('challenges', function (Blueprint $table) {
            $table->dropForeign('challenges_challenged_id');
            $table->dropForeign('challenges_challenger_id');
            $table->dropForeign('challenges_created_by');
            $table->dropForeign('challenges_deleted_by');
            $table->dropForeign('challenges_updated_by');
            $table->dropForeign('challenges_week_id');
            $table->dropForeign('challenges_winner_id');
        });

        Schema::dropIfExists('weeks');

        Schema::dropIfExists('lands');

        Schema::dropIfExists('kingdoms');

        Schema::dropIfExists('flexers');

        Schema::dropIfExists('challenges');
    }
}
