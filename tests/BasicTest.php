<?php


class BasicTest extends TestCase
{
    /** @test */
    public function it_can_reach_the_home_page()
    {
        $this->visit('/')
         ->assertPageLoaded('/');
    }

    /** @test */
    public function it_can_reach_reply_page()
    {
        $this->visit('/answer')
            ->assertPageLoaded('/answer');
    }
}
