<?php
if (!Schema::hasTable('users')) {
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->enum('role', ['student','teacher']);
        $table->timestamps();
    });
}
