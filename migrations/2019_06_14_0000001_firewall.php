<?php
use Illuminate\Database\Schema\Firewall;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class Firewall extends Migration
{
    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->create('firewall', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number')->unique();
            $table->boolean('allowdownloadsignedenabled')->nullable();
            $table->boolean('allowsignedenabled')->nullable();
            $table->text('applications')->nullable();
            $table->boolean('firewallunload')->nullable();
            $table->integer('globalstate')->nullable();
            $table->boolean('loggingenabled')->nullable();
            $table->integer('loggingoption')->nullable();
            $table->text('services')->nullable();
            $table->boolean('stealthenabled')->nullable();
            $table->string('version')->nullable();
           
            $table->index('serial_number');
            $table->index('allowdownloadsignedenabled');
            $table->index('allowsignedenabled');
            $table->index('firewallunload');
            $table->index('loggingenabled');
            $table->index('stealthenabled');
        });
    }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('firewall');
    }
}
