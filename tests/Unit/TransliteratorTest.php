<?php

namespace Tests\Unit;

use App\Services\Transliterator;
use PHPUnit\Framework\TestCase;

class TransliteratorTest extends TestCase
{
    /** @test */
    public function transliterator_will_convert_string_to_bold()
    {
        $string = 'Čokančićem ću te, čokančićem ćeš me, župane Đoko';

        $translated = with(new Transliterator())->transliterate($string);

        $this->assertEquals('Cokancicem cu te, cokancicem ces me, zupane Djoko', $translated);
    }
}
