<?php

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faq = new Faq;
        $faq->question_de = 'Pitanje 1';
        $faq->answer_de = 'Odgovor 1';
        $faq->save();

        $faq = new Faq;
        $faq->question_de = 'Pitanje 2';
        $faq->answer_de = 'Odgovor 2';
        $faq->save();

        $faq = new Faq;
        $faq->question_de = 'Pitanje 3';
        $faq->answer_de = 'Odgovor 3';
        $faq->save();

        $faq = new Faq;
        $faq->question_de = 'Pitanje 4';
        $faq->answer_de = 'Odgovor 4';
        $faq->save();
    }
}
