public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->unsignedInteger('price'); // Цена в копейках/центах для точности
        $table->timestamps();
    });
}
