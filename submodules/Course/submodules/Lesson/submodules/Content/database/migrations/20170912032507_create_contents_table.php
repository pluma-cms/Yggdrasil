<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Migration\Migration;
use Phinx\Migration\AbstractMigration;

class CreateContentsTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $tablename = 'contents';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ($this->schema->hasTable($this->tablename)) {
            return;
        }

        $this->schema->create($this->tablename, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id')->unsigned();
            $table->integer('sort')->default(0);
            $table->string('title');
            $table->text('body')->nullable();
            $table->text('delta')->nullable();
            $table->string('icon')->nullable();
            $table->integer('library_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('lesson_id')->references('id')->on('lessons')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('library_id')->references('id')->on('library');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists($this->tablename);
    }
}
