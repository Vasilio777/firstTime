<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lection;
use App\Models\Addmat;
use App\Models\Video;
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
//         $this->call(AddmatsTableSeeder::class);
//        $this->call(VideosTableSeeder::class);

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
    }
}
class CoursesTableSeeder extends Seeder {
    public function run() {
        Course::create([
            'coursetitle' => 'Java',
            'cdesc' => 'yaa yaah yaa yaah',
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
            'ltitle' => 'Лекция №1',
            'ldesc' => 'ABRAKADAMBRA в совокупности с НУ ОЧЕНЬ ОЧЕНЬ ОЧЕНЬНУ ОЧЕНЬ ОЧЕНЬ ОЧЕНЬ НУ ОЧЕНЬ ОЧЕНЬ ОЧЕНЬ НУ ОЧЕНЬ ОЧЕНЬ ОЧЕНЬ НУ ОЧЕНЬ ОЧЕНЬ ОЧЕНЬ ДЛИННЫМ ОПИСАНИЕМ'
        ]);
        Lection::create([
            'idcourse' => '1',
            'ltitle' => 'Лекция №2',
            'ldesc' => '222ABRAKADAMBRA2',
        ]);
    }
}
//class VideosTableSeeder extends Seeder
//{
//    public function run()
//    {
//        Video::create([
//            'idvlec' => '1',
//            'vtitle' => 'Life is strange.mpeg',
//            'vdesc' => 'ЙОХОХОХОafafaafafafa fafafafafaf gjedo dadlfl mhlafal lndawndllnuaw awoihawl ndaw.',
//        ]);
//        Video::create([
//            'idvlec' => '1',
//            'vtitle' => 'Harlem Shake (в армии).mpeg',
//            'vdesc' => 'двадвадваЙОХОХОХОafaafafafafafafafafafafffffffffffffffffffffafafafa.',
//        ]);
//    }
//}
//class AddmatsTableSeeder extends Seeder {
//    public function run() {
//        Addmat::create([
//            'idaddlec' => '1',
//            'addtitle' => 'Mosty тит нач 4к.doc',
//        ]);
//        Addmat::create([
//            'idaddlec' => '2',
//            'addtitle' => 'Мосты IV_1.docx',
//        ]);
//        Addmat::create([
//            'idaddlec' => '2',
//            'addtitle' => 'СИС правл..pdf',
//        ]);
//    }
//}