<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('steps')->insert([
            [
                'name' => '英語で日常会話ができるようになりたい！',
                'content' => '突然ですが「あー、英語が喋れたらなぁ...」って考えたことありませんか？私はずっとそう思っていました。仕事にするほどではないけれど、英語で日常会話くらいペラペラっと喋れて海外にも気軽に行けたら楽しそうだなー、なんて。でも英会話塾に行くのもお金がかかるし、どうにも一歩踏み出せない。そんな日常を今日から変えましょう。Netflixさえあればとりあえず始められる英語習得へのステップを考えました！私が実際に使った方法なのできっとあなたも達成できるはず！さあ、始めましょう！',
                'image' => 'img/waiter.jpg',
                'child_num' => 2,
                'user_id' => 1,
                'category_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
