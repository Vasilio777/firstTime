<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lection;
use App\Models\Addmat;
use App\Models\User;
use App\Models\Course;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(LectionsTableSeeder::class);
        $this->call(AddmatsTableSeeder::class);

        Model::reguard();
    }
}
class UserTableSeeder extends Seeder {
    public function run() {
        User::create([
            'name' => 'Admin',
            'email' => 'portal@mail.ru',
            'isPrepod' => '1',
            'password' => Hash::make('nimda'),
        ]);
        User::create([
            'name' => 'Papka',
            'email' => 'myemail@mail.ru',
            'isPrepod' => '0',
            'password' => Hash::make('papka'),
        ]);
    }
}
class CoursesTableSeeder extends Seeder {
    public function run() {
        Course::create([
            'coursetitle' => 'Java',
            'cdesc' => 'Java — кроссплатформенный язык программирования с мощным набором библиотек практически на все случаи жизни.',
            'requirements' => 'хорошо разобраться с ООП, в java эта парадигма - основа языка (класы, интерфейсы, абстрактные класы); изучить базовые классы для того, чтоб при написании программы вы не тратили много времени на поиск (работа с файлами, с сетью, написание ГУИ, сортировки, работа с БД); освоить обработку ошибок и работу с потоками.',
            'forWhom' => 'Хотите стать java юниором с уклоном к веб - не проблема!',
            'image' => 'Java.png',
        ]);
        Course::create([
            'coursetitle' => 'C#',
            'cdesc' => 'Скоро',
            'image' => 'Csharp.png',
        ]);
        Course::create([
            'coursetitle' => '3Ds Max',
            'cdesc' => 'Скоро',
            'image' => '3Ds Max.png',
        ]);
        Course::create([
            'coursetitle' => 'Unity3D',
            'cdesc' => 'Скоро',
            'image' => 'Unity3D.png',
                  ]);
        Course::create([
            'coursetitle' => 'Swift',
            'cdesc' => 'Скоро',
            'image' => 'Swift.png',
        ]);
        Course::create([
            'coursetitle' => 'Linux',
            'cdesc' => 'Скоро',
            'image' => 'Linux.png',
        ]);
        Course::create([
            'coursetitle' => 'Maya',
            'cdesc' => 'Скоро',
            'image' => 'Maya.png',
        ]);
        Course::create([
            'coursetitle' => 'AutoCad',
            'cdesc' => 'Скоро',
            'image' => 'AutoCad.png',
        ]);
    }
}
class LectionsTableSeeder extends Seeder
{
    public function run()
    {
        //DB::table('lections')->truncate();  // Truncate чистит ID!!! Не чистит форейн-кеи; поменять на delete, если придётся после продакшна пересидить.
        Lection::create([
            'idcourse' => '1',
            'ltitle' => 'IDE_Mac.mp4',
            'ldesc' => 'Лекция написана простым и доступным языком, без книжной зауми и академичности. При этом, она содержит минимум воды — все кратко и по делу.'
        ]);
        Lection::create([
            'idcourse' => '1',
            'ltitle' => 'filisdd.mpeg',
            'ldesc' => 'Читайте эту лекцию, получайте все необходимые теоретические знания и когда освоите необходимый минимум, приступайте к практике.',
        ]);
    }
}
class AddmatsTableSeeder extends Seeder
{
    public function run()
    {
        //DB::table('lections')->truncate();  // Truncate чистит ID!!! Не чистит форейн-кеи; поменять на delete, если придётся после продакшна пересидить.
        Addmat::create([
            'idaddlec' => '1',
            'addtitle' => 'Лекция 1. Encoding.pptx',
        ]);
        Addmat::create([
            'idaddlec' => '1',
            'addtitle' => 'Лекция 1. Encoding.xps',
        ]);
    }
}