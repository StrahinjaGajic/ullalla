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
        $faq->question = 'Pitanje 1';
        $faq->answer = 'Odgovor 1';
        $faq->save();

        $faq = new Faq;
        $faq->question = 'Pitanje 2';
        $faq->answer = 'Odgovor 2';
        $faq->save();

        $faq = new Faq;
        $faq->question = 'Pitanje 3';
        $faq->answer = 'Odgovor 3';
        $faq->save();

        $faq = new Faq;
        $faq->question = 'Pitanje 4';
        $faq->answer = 'Odgovor 4';
        $faq->save();
    }
}
