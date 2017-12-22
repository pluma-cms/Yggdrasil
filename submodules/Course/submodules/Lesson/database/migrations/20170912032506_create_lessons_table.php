<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Migration\Migration;
use Phinx\Migration\AbstractMigration;

class CreateLessonsTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $tablename = 'lessons';

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
            $table->integer('course_id')->unsigned();
            $table->integer('assignment_id')->unsigned()->nullable();
            $table->integer('sort')->default(0);
            $table->string('title');
            $table->string('icon')->nullable();
            $table->string('feature')->nullable();
            $table->text('body')->nullable();
            $table->text('delta')->nullable();
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('assignment_id')->references('id')->on('assignments');
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
