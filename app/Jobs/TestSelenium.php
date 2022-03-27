<?php

namespace App\Jobs;

use App\Traits\Selenium;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestSelenium implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Selenium;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->driver = $this->createDriver();
        } catch (Exception $exception) {
           logger('Cannot create driver');
           logger($exception->getMessage());

        };

        $this->driver->get('https://google.com/');
        sleep(5);

        logger('Page title: ' . $this->driver->getTitle());

        $this->driver->quit();

    }

    
}
