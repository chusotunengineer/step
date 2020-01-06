<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ChildStepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('child_steps')->insert([
            [
                'parent_id' => 1,
                'name' => '海外ドラマを英語音声で観てみよう！',
                'content' => 'まずは海外ドラマを英語音声と日本語字幕で観てみることから始めましょう！\n英語に耳を慣らすということですね！\nお好きな物を選んでもらって大丈夫ですが、派手なアクションやセリフが難解になりがちなサスペンスよりもフレンズのようなコメディがオススメですよ〜',
                'order' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'parent_id' => 1,
                'name' => '海外ドラマを日本語字幕を消して観てみよう！',
                'content' => 'まずは海外ドラマを英語音声と日本語字幕で観てみることから始めましょう！英語に耳を慣らすということですね！お好きな物を選んでもらって大丈夫ですが、派手なアクションやセリフが難解になりがちなサスペンスよりもフレンズのようなコメディがオススメですよ〜',
                'order' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
